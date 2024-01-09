<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // view cagtegory list page
    public function list(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->when($request->key, function ($q) {
                $q->where('name', 'like', '%' . request('key') . '%');
            })
            ->paginate(5)->withQueryString();
        return view('admin.category.list', compact('categories'));
    }

    // view category add page
    public function index()
    {
        return view('admin.category.add');
    }

    // store category add
    public function store(Request $request)
    {
        $request->validate(
            ['category_name' => 'required|unique:categories,name']
        );
        $category = new Category;
        $category->name = $request->category_name;
        $category->save();
        return redirect()->route('admin.category.list')->with('success', 'Successfully add.');
    }

    // view update category page
    public function update($id)
    {
        $category = Category::find($id);
        return view('admin.category.update', compact('category'));
    }

    // store update category
    public function updateStore(Request $request)
    {
        $request->validate(
            ['category_name' => 'required|unique:categories,id,' . $request->category_id]
        );
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->update();
        return redirect()->route('admin.category.list')->with('success', 'Successfully updated.');
    }

    // delete category
    public function delete($id)
    {
        $categoriy = Category::find($id);
        $categoriy->delete();
        return back()->with('success', 'Delete success.');
    }
}
