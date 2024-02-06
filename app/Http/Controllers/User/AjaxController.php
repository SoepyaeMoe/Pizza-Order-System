<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    // filter by price, category, limit
    public function sorting(Request $request)
    {
        if (!empty($request)) {
            $products = Product::limit($request->showing);
            if ($request->price1) {
                $products = $products->orWhereBetween('price', [1000, 10000]);
            }
            if ($request->price2) {
                $products = $products->orWhereBetween('price', [20000, 30000]);
            }
            if ($request->price3) {
                $products = $products->orWhereBetween('price', [30000, 35000]);
            }
            if ($request->price4) {
                $products = $products->orWhereBetween('price', [35000, 40000]);
            }
            if ($request->price5) {
                $products = $products->orWhereBetween('price', [40000, 60000]);
            }

            if ($request->status) {
                $products = $products->orderBy('created_at', $request->status);
            }
            if ($request->category_id) {
                $products = $products->where('category_id', $request->category_id);
            }
            $products = $products->get();
            return response()->json([
                'status' => 'success',
                'data' => $products,
            ]);
        }
    }

    public function cart(Request $request)
    {
        $isInCart = Cart::where('product_id', $request->product_id)->first();
        if ($isInCart) {
            $isInCart->quantity = $isInCart->quantity + $request->qty;
            $isInCart->update();
        } else {
            $cart = new Cart;
            $cart->user_id = $request->user_id;
            $cart->product_id = $request->product_id;
            $cart->price = $request->price;
            $cart->quantity = $request->qty;
            $cart->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Success add to cart',
        ]);
    }

    public function remove(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->first();
        $cart->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'A product was remove from cart.',
        ]);
    }

    public function plus(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->where('user_id', Auth::user()->id)->first();
        $cart->quantity = $request->qty;
        $cart->update();

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $sub_total = 0;
        $total_price = $cart->quantity * $cart->price;
        foreach ($carts as $c) {
            $sub_total += $c->price * $c->quantity;
        }
        return response()->json([
            'status' => 'success',
            'total_price' => $total_price,
            'sub_total' => $sub_total,
        ]);
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        $total_price = 0;
        foreach ($request->all() as $item) {
            OrderList::create($item);
            $cart = Cart::where('product_id', $item['product_id'])->where('user_id', $user->id)->first();
            $cart->delete();
            $total_price += $item['total_price'];
        }
        Order::create([
            'user_id' => $item['user_id'],
            // 'product_id' => $item['product_id'],
            'order_code' => $item['order_code'],
            'total_price' => $total_price + 3000,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully ordered.',
        ]);
    }

    public function IncViewCount(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $product->view_count = $product->view_count + 1;
        $product->update();
        return response()->json([
            'status' => 'success',
            'data' => $product->view_count,
        ]);
    }

    // user contact send message
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email|max:50',
            'phone' => 'required|max:11|min:7',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ]);
        }
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Success send message.',
        ]);
    }

    // admin contact delete
    public function contactDelete(Request $request)
    {
        Contact::find($request->contact_id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'A contact message was deleted',
        ]);
    }
}