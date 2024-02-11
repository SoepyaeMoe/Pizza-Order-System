<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProfileResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $productList;
        if (!empty($request->category)) {
            $products = Product::where('category_id', $request->category);
            if ($request->sorting) {
                $products = $products->orderBy('updated_at', $request->sorting);
            }
            $products = $products->get();
            $productList = ProductResource::collection($products);
        } else {
            if ($request->sorting) {
                $products = Product::orderBy('id', $request->sorting)->get();
                $productList = ProductResource::collection($products);
            } else {
                $products = Product::orderBy('id', 'desc')->get();
                $productList = ProductResource::collection($products);
            }
        }

        $user = Auth::user();
        $categories = Category::get();
        $catgoryList = CategoryResource::collection($categories);
        $userInfo = new ProfileResource($user);

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => [
                'userInfo' => $userInfo,
                'productList' => $productList,
                'catgoryList' => $catgoryList,

            ],
        ]);

    }
    public function profile()
    {
        $user = Auth::user();
        $userInfo = new ProfileResource($user);

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $userInfo,
        ]);
    }

    public function products()
    {
        $products = Product::get();
        $productList = ProductResource::collection($products);
        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $productList,
        ]);
    }

    public function productDetail($id, Request $request)
    {
        $user = Auth::user();
        $product = Product::find($id);
        $productInfo = new ProductResource($product);
        if (!empty($product)) {
            if (!empty($request->quantity)) {
                $cart = Cart::where('product_id', $id)->where('user_id', $user->id)->first();
                if (!empty($cart)) {
                    $cart->quantity = $cart->quantity + $request->quantity;
                    $cart->update();
                } else {
                    Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'quantity' => $request->quantity,
                        'price' => $product->price,
                    ]);
                }
                return response()->json([
                    'status' => 1,
                    'message' => 'Add to cart success.',
                ]);
            }

            $product->view_count = $product->view_count + 1;
            $product->update();
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'data' => $productInfo,
            ]);

        }
        return response()->json([
            'status' => 0,
            'message' => 'Unknown product',
        ]);
    }

    public function addQty($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity + 1;
        $cart->update();

        return response()->json([
            'status' => 1,
            'message' => 'success',
        ]);
    }

    public function decQty($id)
    {
        $cart = Cart::find($id);
        if ($cart->quantity == 1) {
            return;
        }
        $cart->quantity = $cart->quantity - 1;
        $cart->update();

        return response()->json([
            'status' => 1,
            'message' => 'success',
        ]);
    }

    public function category()
    {
        $categories = Category::get();
        $catgoryList = CategoryResource::collection($categories);
        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $catgoryList,
        ]);
    }

    public function cart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $cartList = CartResource::collection($cart);
        return response([
            'status' => 1,
            'message' => 'success',
            'deli_charge' => '3000 Kyats',
            'data' => $cartList,
        ]);
    }

    public function removeCart($id)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('product_id', $id)->first();
        if (!empty($cart)) {
            $cart->delete();
            return response()->json([
                'status' => 1,
                'message' => 'A product was remove from cart',
            ]);
        }
        return response()->json([
            'status' => 0,
            'message' => 'Unknown product',
        ]);
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $cartList = CartResource::collection($cart);
        $orderCode = $user->id . rand(1000000, 9999999);
        $total_price = 0;
        foreach ($cartList as $cart) {
            OrderList::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'total_price' => $cart->price * $cart->quantity,
                'order_code' => $orderCode,
            ]);
            $total_price += $cart->price * $cart->quantity;
            $cart = Cart::where('product_id', $cart->product_id)->where('user_id', $user->id)->first();
            $cart->delete();
        }
        Order::create([
            'user_id' => $user->id,
            'total_price' => $total_price + 3000,
            'order_code' => $orderCode,
            'status' => 0,
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Successfully ordered',
        ]);
    }

    public function order()
    {
        $orders = Order::orderBy('updated_at', 'desc')->where('user_id', Auth::user()->id)->get();
        $orderList = OrderResource::collection($orders);
        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $orderList,
        ]);
    }

    // contact
    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:5|max:11',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'fail',
                'data' => $validator->errors(),
            ]);
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $contact,
        ]);
    }

    // upload photo
    public function uploadPhoto(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('photo');
        if ($file) {

            $validator = Validator::make($request->all(), [
                'photo' => 'extensions:jpg,jpeg,png,wepb|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'fail',
                    'data' => $validator->errors(),
                ]);
            }

            if ($user->image) {
                Storage::delete(['public/profile_pic/' . $user->image]);
            }

            $name = $file->hashName();
            $file->storeAs('public/profile_pic', $name);
            $user->image = $name;
            $user->update();

            return response()->json([
                'status' => 1,
                'message' => 'success',
                'data' => $name,
            ]);
        }
        return;
    }

    // profile update
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'fail',
                'data' => $validator->errors(),
            ]);
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->update();

        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $user,
        ]);
    }

    // check password
    public function checkPassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 1,
                'message' => 'success',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Wroung password, try again!',
            ]);
        }

    }

    // delte accound
    public function delete()
    {
        $user = Auth::user();
        if ($user->image) {
            Storage::delete(['public/profile_pic/' . $user->image]);
        }
        $user->delete();
        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $user,
        ]);
    }
}
