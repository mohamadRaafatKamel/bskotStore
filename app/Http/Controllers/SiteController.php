<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Emarh;
use App\Models\OrderItem;
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

    public function addOrder($id,Request $request)
    {
//        try {
            $product = Product::find($id);
            if(!isset($_COOKIE['order'])){
                return redirect()->route('delivery');
            }
            if (!$product) {
                return redirect()->route('home')->with(['error' => '  غير موجوده']);
            }
            OrderItem::create(array_merge($request->except('_token'),['pro_id'=>$id,'order_id'=>$_COOKIE['order']]));

//            return redirect()->route('home');
//
//        }catch (\Exception $ex) {
//            return redirect()->route('home');
//        }
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

    public function setlocation(Request $request)
    {
        if(!isset($_COOKIE['order'])) {
            // check frist
            $order= Orders::where('phone',$request->phone)->first();
            setcookie('order', $order->id, time() * ( 60));
            if(!$order){
                $order = Orders::create($request->except(['_token']));
                setcookie('order', $order->id, time() * ( 60));  //365 * 24 * 60 * 60
            }
            return redirect()->route('home');
        }else{
            $myOrder = Orders::find($_COOKIE['order']);
            $myOrder->update($request->except('_token'));
        }
        $this->setCookie($request,'order','55');
        return redirect()->route('home');

    }

    public function cart()
    {
        if(!isset($_COOKIE['order'])){
            $empty = 1;
            return view('front.cart',compact('empty'));
        }else{
            $empty = 0;
        }
        //$this->orderComplet($_COOKIE['order']);
        $order = Orders::find($_COOKIE['order']);
        $items = OrderItem::where('order_id',$order->id)->get();

        return view('front.cart',compact('empty','order','items'));
    }

    public function orderComplet($id)
    {
        $order = new Orders();
        $isOrder = $order->find($id);
        $data=[
            'total_cost'=>$order->culcCostItem($id),
            'time'=>$order->culcTimeDelivery($isOrder->area_id ),
        ];
        $isOrder->update($data);
    }

    public function adress()
    {
        return view('front.adress');
    }

    public function setadress(Request $request)
    {
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        $isOrder->update($request->except(['_token']));
        return redirect()->route('credit');
    }

    public function credit()
    {
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        return view('front.credit',compact('isOrder'));
    }

    public function search()
    {
        //return view('front.home');
    }
/*
    public function setCookie(Request $request,$cookName,$cookValue)
    {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie($cookName, $cookValue, $minutes));
        return $response;
    }

    public function getCookie(Request $request,$cookName)
    {
        $value = $request->cookie($cookName);
        echo $value;
    }
*/



}
