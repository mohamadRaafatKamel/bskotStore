<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::select()->active()->get();
        return view('front.home',compact('categories'));
    }

    public function product($id)
    {
        $category = Category::select()->active()->find($id);
        if (!$category) {
            return redirect()->route('home')->with(['error' => '  غير موجوده']);
        }

        $products = Product::select()->active()->where('cat_id',$id)->get();

        return view('front.product',compact('products'));
    }

    public function view($id)
    {
        $product = Product::select()->find($id);
        if (!$product) {
            return redirect()->route('home')->with(['error' => '  غير موجوده']);
        }
        return view('front.view',compact('product'));
    }

    public function search()
    {
        //return view('front.home');
    }

    public function delivery()
    {
        return view('front.delivery');
    }
}
