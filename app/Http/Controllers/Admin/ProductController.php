<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    ////////////get/////////////

     function AllProducts () {

       $allProducts= Product::all();

        return view('admin.products.Index', ['allProducts' => $allProducts]);
      }


      /////////////////get////////////////////

    function AddProduct () {

     $allCategories = Category::all();
    return view('admin.products.create', ['allCategories' => $allCategories]);

   }

   ///////////////  تعديل المنتج  /////////////////

   function StoreProduct(Request $request)
{
    // Base validation
    $rules = [
        'name' => 'required',
        'price' => 'required',
        'quantity' => 'required',
        'images.*' => 'image|mimes:png,jpg,jpeg|max:2048', // multiple images
    ];

    // Main image rule (only required for new products)
    if (!$request->id) {
        $rules['image'] = 'required|image|mimes:png,jpg,jpeg|max:2048';
    } else if ($request->hasFile('image')) {
        $rules['image'] = 'image|mimes:png,jpg,jpeg|max:2048';
    }

    $request->validate($rules);

    // === EDIT PRODUCT ===
    if ($request->id) {
        $currentProduct = Product::findOrFail($request->id);
        $currentProduct->name = $request->name;
        $currentProduct->price = $request->price;
        $currentProduct->quantity = $request->quantity;
        $currentProduct->description = $request->description;
        $currentProduct->category_id = $request->category_id;

        // Replace main image if uploaded
        if ($request->hasFile('image')) {
            $filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $filename);
            $currentProduct->imagepath = 'uploads/' . $filename;
        }

        $currentProduct->save();

        // Optional: handle adding new images even during edit
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imgName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $imgName);

                ProductImage::create([
                    'product_id' => $currentProduct->id,
                    'image_path' => 'uploads/products/' . $imgName,
                ]);
            }
        }

        return redirect('/allproducts');
    }

    // === ADD NEW PRODUCT ===
    else {
        $newProduct = new Product();
        $newProduct->name = $request->name;
        $newProduct->price = $request->price;
        $newProduct->quantity = $request->quantity;
        $newProduct->description = $request->description;
        $newProduct->category_id = $request->category_id;

        $filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $filename);
        $newProduct->imagepath = 'uploads/' . $filename;

        $newProduct->save();

        // Save multiple extra images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $imgName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/products'), $imgName);

                ProductImage::create([
                    'product_id' => $newProduct->id,
                    'image_path' => 'uploads/products/' . $imgName,
                ]);
            }
        }

        return redirect('/allproducts');
    }
}

////////////////////////////////////////////////////////

    function RemoveProduct ($productid) {

        $currentProduct = Product::find($productid);
        $currentProduct-> delete();

        return  redirect('/allproducts')->with('success', 'Product deleted successfully!');
    }

    ///////////////get///////////////////

    function EditProduct ($productid = null) {

        if ($productid != null) {
        $currentProduct = Product::find($productid );

        if($productid == null){
            abort("403","please add the product id");
        }
        $allCategories = Category::all();

           return view('admin.products.edit', ['product' => $currentProduct, 'allCategories' => $allCategories]);
         }
         else
         {
           return redirect('/addproduct');

        }
    }

//user side
    public function show($id)
{
    $product = Product::with('images')->findOrFail($id);
    return view('show', compact('product'));
}

}
