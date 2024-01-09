<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function productDetail($id)
    {
        $product = Product::where('id', $id)->first();
        $productsList = Product::get();
        return view('user.product.detail', compact('product', 'productsList'));
    }

    public function cart()
    {
        $carts = Cart::select('carts.*', 'users.name as user_name', 'products.name as product_name', 'products.id as product_id')
            ->leftJoin('users', 'users.id', 'carts.user_id')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->price * $cart->quantity;
        }
        return view('user.product.cart', compact('carts', 'totalPrice'));
    }

    public function order()
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(5);
        return view('user.product.order', compact('orders'));
    }

    public function index()
    {
        return view('user.contact');
    }
}
