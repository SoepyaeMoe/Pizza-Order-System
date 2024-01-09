<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $products = Product::with('category');
        if ($request->category) {
            $products = $products->where('category_id', $request->category);
        }
        $products = $products->orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $active_cate = Category::where('id', $request->category)->first();
        return view('user.home', compact('products', 'categories', 'active_cate'));
    }

    // custormer list
    public function list()
    {
        $customers = User::where('role', 'user')->get();
        return view('admin.customer.list', compact('customers'));
    }

    // customer delete
    public function delete(Request $request)
    {
        $user = User::where('id', $request->customer_id)->first();
        $order_list = OrderList::where('user_id', $user->id)->get();
        $order = Order::where('user_id', $user->id)->get();
        $cart = Cart::where('user_id', $user->id)->get();

        DB::beginTransaction();
        try {
            if (!empty($user->image)) {
                Storage::delete('profile_pic/' . $user->image);
            }
            foreach ($order_list as $ol) {
                $ol->delete();
            }
            foreach ($order as $o) {
                $o->delete();
            }
            foreach ($cart as $c) {
                $c->delete();
            }
            $user->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Your file has been deleted.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something wroung!');
        }
    }

    public function chagePassword()
    {
        return view('user.profile.change_password');
    }
    public function changePasswordStore(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password|min:8',
            ]
        );

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();
            return redirect()->route('home')->with('success', 'Password successfully changed.');
        }
        return back()->withErrors(['old_password' => 'Old password incorrect.']);
    }
}
