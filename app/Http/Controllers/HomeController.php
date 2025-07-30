<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;


class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only('index'); ;
    }

    public function index()
    {
        return view('home');
    }

    public function ContactUs(){

    return view('contact');
   }

   public function About(){

    return view('about');
   }

    function MainPage () {

 $result= Category::all();
  $sliders = Slider::all();

    return view('welcome', ['categories' => $result , 'sliders' => $sliders]);
}

function GetCategoryProduct () {

    $products = Product::all();
    $categories = Category::all();
    return view('category', ['products' => $products,'categories' => $categories]);
}

function GetProduct ($catid = null) {

    $categories = Category::all();

    if($catid) {

      $result = Product::where('category_id', $catid)->paginate(6);

       return view('product', ['products' => $result, 'categories' => $categories]);

    }
    else{
        $result= Product::paginate(6);
        return view('product', ['products' => $result, 'categories' => $categories]);
    }

}

/////////البحث عن المنتتجات/////////

function SearchProducts(Request $request){

    $product = Product::where('name', 'like', '%'.$request -> searchKey.'%')->paginate(6);

    return view('product', ['products' => $product]);
}
}
