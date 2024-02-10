<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Categories::all();
        return view('category.index', compact('category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request, Categories $category)
    {
        $image_path = '';

        if ($request->hasFile('photo')) {
            $image_path = $request->file('photo')->store('categories', 'public');
        }
        $category = Categories::create([
            'cate_name' => $request->cate_name,
            'description' => $request->description,
            'photo' => $image_path,
        ]);
        return redirect(route('category.index'));
    }

    public function edit(Categories $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryStoreRequest $request, Categories $category)
    {
        $category->cate_name = $request->cate_name;
        $category->description = $request->description;
        if ($request->hasFile('photo')) {
            // Delete old image
            if ($category->photo) {
                Storage::delete($category->photo);
            }
            // Store image
            $image_path = $request->file('photo')->store('categories', 'public');
            // Save to Database
            $category->photo = $image_path;
        }

        if (!$category->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating product.');
        }
        return redirect()->route('category.index')->with('success', 'Success, Product has been updated.');
    }


    public function destroy($id)
    {
        $category = Categories::find($id);
        if ($category->photo) {
            Storage::delete($category->photo);
        }
        $category->delete();

        return redirect()->back();
    }
}
