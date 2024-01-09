<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function home()
    {
        $products = Product::when(request('key'), function ($q) {
            $q->where('name', 'like', '%' . request('key') . '%');
        })->with('category')->paginate(5)->withQueryString();

        return view('admin.home', compact('products'));
    }

    // change password
    public function changePassword()
    {
        return view('admin.profile.change_password');
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
            return redirect()->route('admin.home')->with('success', 'Password successfully changed.');
        }
        return back()->withErrors(['old_password' => 'Old password incorrect.']);
    }

    // profile info
    public function profileDetail()
    {
        $user = Auth::user();
        return view('admin.profile.detail', compact('user'));
    }

    public function profileEdit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function profileEditStore(Request $request)
    {
        $user = Auth::user();

        $request->validate(
            [
                'name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,id,' . $user->id,
                'phone' => 'required|min:5|unique:users,id,' . $user->id,
                'profile_pic' => 'extensions:jpg,jpeg,png,wepb|max:2048',
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->file('profile_pic')) {
            $file = $request->file('profile_pic');
            $name = $file->hashName();

            if ($user->image) {
                Storage::delete(['public/profile_pic/' . $user->image]);
            }
            $file->storeAs('public/profile_pic', $name);
            $user->image = $name;
        }
        $user->update();
        return redirect()->route('admin.profile.detail')->with('success', 'Successfully updated.');
    }

    // admin list
    public function list(Request $request)
    {
        // $admins = User::where('role', 'admin')->paginate(5)->withQueryString();
        $admins = User::adminList();
        return view('admin.admin_list.list', compact('admins'));
    }

    public function delete($id)
    {
        $admin = User::where('id', $id)->first();
        $admin->delete();
        return back()->with('success', 'Delete success.');
    }
}
