<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Emarh;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use http\Cookie;
use mysql_xdevapi\Exception;
use Twilio\Rest\Client;
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
            $order= Orders::where('phone',"+965".$request->phone)->first();
            if(!$order){
                $request->merge([
                    'phone' => "+965".$request->phone,
                ]);
                $order = Orders::create($request->except(['_token']));
                setcookie('order', $order->id, time() * ( 60));  //365 * 24 * 60 * 60
            }else{
                setcookie('order', $order->id, time() * ( 60));
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
        if(!isset($_COOKIE['order'])){
            return redirect()->route('cart');
        }
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        return view('front.adress',compact('isOrder'));
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
        if(!isset($_COOKIE['order'])){
            return redirect()->route('cart');
        }
        // normal view
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);

        // after payment
        if(\request('id') && \request('resourcePath')){
            $payment_status = $this->getPaymentStatus(\request('id') , \request('resourcePath'));

            if (isset($payment_status['id'])) { //success payment id -> transaction bank id
                $paymentMessage = true;
                $isOrder->update(['bank_transaction_id'=>$payment_status['id'] , 'state'=>1]);
                return redirect()->route('thankspage');
                //save order in orders table with transaction id  = $payment_status['id']
                //return view($this->module_view_folder . '.details',compact('offer'));
            } else {
                $paymentMessage = false;
                //return view($this->module_view_folder . '.details',compact('offer'));
            }
        }


        return view('front.credit',compact('isOrder','paymentMessage'));
    }

    private function getPaymentStatus($id, $resourcepath)
    {
        //$url = config('payment.hyperpay.url');
        //$url = "https://test.oppwa.com/";
        //$url .= $resourcepath;
        //$url .= "?entityId=" . config('payment.hyperpay.entity_id');

        $url = "https://test.oppwa.com/v1/checkouts/".$id."/payment";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //    'Authorization:Bearer ' . config('payment.hyperpay.auth_key')));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, config('payment.hyperpay.production'));// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);

    }

    public function cash()
    {
        if(!isset($_COOKIE['order'])){
            return redirect()->route('cart');
        }
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        $isOrder->update(['state'=>'2','pay_way'=>2]);
        return redirect()->route('thankspage');
    }

    public function thankspage()
    {
        if(!isset($_COOKIE['order'])){
            return redirect()->route('cart');
        }
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        $recipient = $isOrder->phone;
        $otp = rand(1000,9999);
        $isOrder->update(['otp'=>$otp]);
        $body = "OTP Code : ".$otp;
        try {
            $this->sendMessage($body, $recipient);
            return view('front.thankspage');
        }catch (\Exception $ex){

        }
        return view('front.thankspage')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);

    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }

    public function otpview()
    {
        return view('front.otpview');
    }

    public function otpCheck(Request $request)
    {
        if(isset($_COOKIE['order'])){
            $order = new Orders();
            $isOrder = $order->find($_COOKIE['order']);
            if($request->otp == $isOrder->otp){
                $isOrder->update(['otp_check'=>1]);
                return redirect()->route('otpview')->with(['success' => 'thank for confirm']);
            }else{
                return redirect()->route('otpview')->with(['error' => 'Not same OTP code']);
            }

        }
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
