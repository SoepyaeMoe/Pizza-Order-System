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
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $productList;
        if (!empty($request->category)) {
            $products = Product::where('category_id', $request->category)->get();
            $productList = ProductResource::collection($products);
        } else {
            $products = Product::get();
            $productList = ProductResource::collection($products);
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
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                ]);
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
            'data' => $cartList,
        ]);
    }

    public function removeCart($id)
    {
        $cart = Cart::find($id);
        if (!empty($cart)) {
            $cart->delete();
            return response()->json([
                'status' => 1,
                'message' => 'A product was remove from cart',
            ]);
        }
        return response()->josn([
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
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $orderList = OrderResource::collection($orders);
        return response()->json([
            'status' => 1,
            'message' => 'success',
            'data' => $orderList,
        ]);
    }
}
