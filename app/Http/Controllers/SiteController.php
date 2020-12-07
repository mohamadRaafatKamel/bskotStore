<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Emarh;
use App\Models\Orders;
use App\Models\Product;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $data = [];
        $emarhs = Emarh::select()->active()->get();
        if ($emarhs) {
            foreach ($emarhs as $emarh) {
                $areas = Area::select()->active()->where('emarh_id', $emarh->id)->get();
                if ($areas) {
                    $data [] = [
                        'emarhName' => $emarh->name_en,
                        'areas' => $areas,
                    ];
                }
            }
        }
        if(isset($_COOKIE['order'])) {
            $myOrder = Orders::select()->find($_COOKIE['order']);
        }
        return view('front.delivery',compact('data','myOrder'));
    }

    public function setlocation(Request $request){
        if(!isset($_COOKIE['order'])) {
            $order = Orders::create($request->except(['_token']));
            setcookie('order', $order->id, time() + (86400 * 30 * 10));  // 10 day
            return redirect()->route('credit');
        }else{
            $myOrder = Orders::find($_COOKIE['order']);
            $myOrder->update($request->except('_token'));
        }
        return redirect()->route('home');

    }




}
