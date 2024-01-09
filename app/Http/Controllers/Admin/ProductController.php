<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::when(request('key'), function ($q) {
            $q->where('name', 'like', '%' . request('key') . '%');
        })->with('category')->paginate(4)->withQueryString();

        return view('admin.product.list', compact('products'));
    }
    public function createPage()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:30|unique:products,id',
            'category' => 'required',
            'price' => 'required|min:4|max:8',
            'pizza_image' => 'required|mimes:png,jpg,jpeg,webp',
            'description' => 'required',
        ]);
        $product = new Product;
        $product->name = $request->product_name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->view_count = 0;
        if ($request->file('pizza_image')) {
            $file = $request->file('pizza_image');
            $name = $file->hashName();
            $file->storeAs('public/product_img', $name);
            $product->image = $name;
        }
        $product->save();
        return redirect()->route('admin.product.list')->with('success', 'Product sucessfully created.');

    }
    public function updatePage($id)
    {
        $product = Product::with('category')->find($id);
        $categories = Category::get();
        return view('admin.product.update', compact('product', 'categories'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:30|unique:products,id',
            'category' => 'required',
            'price' => 'required|min:4|max:8',
            'pizza_image' => 'mimes:png,jpg,jpeg,webp',
            'description' => 'required',
        ]);

        $product = Product::find($request->product_id);
        $product->name = $request->product_name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->file('pizza_image')) {
            $file = $request->file('pizza_image');
            $name = $file->hashName();
            if ($product->image) {
                Storage::delete('public/product_img/' . $product->image);
            }
            $file->storeAs('public/product_img', $name);
            $product->image = $name;
        }
        $product->update();
        return redirect()->route('admin.product.list')->with('success', 'Update success.');
    }
    public function detail($id)
    {
        $product = Product::with('category')->find($id);
        return view('admin.product.detail', compact('product'));
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('success', 'Delete success');
    }
}
