<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    //get
    public function GetAllCategories(){

        $allCats = Category::all();

        return view('admin.category.index', compact('allCats'));
    }

     //get
    public function CreateCategory(){

        return view('admin.category.create');
    }
     //post // اضافة كاتيغوري
    public function StoreCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048', // Image is REQUIRED for new categories
        ]);

        $cat = new Category();
        $cat->name = $request->name;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/categories'), $imageName);
            $cat->imagepath = 'uploads/categories/' . $imageName; // <-- CHANGED: Use 'imagepath'
        }

        $cat->save();

        session()->flash('success', 'Category added successfully!');
        return redirect()->route('admin.category.index');

    }

    public function EditCategory(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    // تعديل الكاتيغوري
    public function UpdateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', // Image is OPTIONAL for update
        ]);

        $category->name = $request->name;

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->imagepath && File::exists(public_path($category->imagepath))) { // <-- CHANGED: Use 'imagepath'
                File::delete(public_path($category->imagepath)); // <-- CHANGED: Use 'imagepath'
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/categories'), $imageName);
            $category->imagepath = 'uploads/categories/' . $imageName; // <-- CHANGED: Use 'imagepath'
        }

        $category->save();

        session()->flash('success', 'Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    // حذف كاتيغوري
     public function DestroyCategory(Category $category)
    {
        // 1. Check if the category has any associated products
        if ($category->products()->count() > 0) {
            // If it has products, flash an error message and redirect back
            session()->flash('error', 'Cannot delete this category because it has associated products. Please reassign or delete products in this category first.');
            return redirect()->route('admin.category.index');
        }

        // 2. If no products are associated, proceed with deletion
        $category->delete();

        // 3. Redirect back to the category index with a success message
        session()->flash('success', 'Category deleted successfully!');
        return redirect()->route('admin.category.index');
    }


}
