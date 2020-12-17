<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Emarh;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use App\Models\PromoCode;
use http\Cookie;
use Illuminate\Support\Facades\App;
use mysql_xdevapi\Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiteController extends Controller
{
    public function index()
    {
        $categories = Category::select()->active()->get();

        // button data
        $myitem = null;
        if(isset($_COOKIE['order'])){
            $order = new Orders();
            $items = OrderItem::where(['order_id'=>$_COOKIE['order']])->get();
            if($items){
                foreach ($items as $item){
                    $myitem[$item->pro_id ] = $item->pro_amount ;
                }
                $myitem['allItems']=$order->culcContItem($_COOKIE['order']) ;
                $myitem['costItems']=$order->culcCostItem($_COOKIE['order']) ;
            }
        }

        return view('front.home',compact('categories','myitem'));
    }

    public function product($id)
    {
        $category = Category::select()->active()->find($id);
        if (!$category) {
            return redirect()->route('home')->with(['error' => '  غير موجوده']);
        }

        $myitem = null;
        if(isset($_COOKIE['order'])){
            $order = new Orders();
            $items = OrderItem::where(['order_id'=>$_COOKIE['order']])->get();
            if($items){
                foreach ($items as $item){
                    $myitem[$item->pro_id ] = $item->pro_amount ;
                }
                $myitem['allItems']=$order->culcContItem($_COOKIE['order']) ;
                $myitem['costItems']=$order->culcCostItem($_COOKIE['order']) ;
            }
        }

        $products = Product::select()->active()->where('cat_id',$id)->get();

        return view('front.product',compact('products','myitem','category'));
    }

    public function view($id)
    {
        $product = Product::select()->find($id);
        if (!$product) {
            return redirect()->route('home')->with(['error' => '  غير موجوده']);
        }
        if(isset($_COOKIE['order'])){
            $item = OrderItem::where(['pro_id'=>$id,'order_id'=>$_COOKIE['order']])->first();
        }else{
            $item = null;
        }

        return view('front.view',compact('product','item'));
    }

    public function addOrder($id,Request $request)
    {
        try {
            //Check cookies
            if(!isset($_COOKIE['order'])){
                return redirect()->route('delivery');
            }

            //Check product
            $product = Product::find($id);
            if (!$product) {
                return redirect()->route('home')->with(['error' => '  غير موجوده']);
            }

            //check before add
            $item = OrderItem::where(['pro_id'=>$id,'order_id'=>$_COOKIE['order']])->first();
            if($item) {
                $item->update($request->except('_token'));
            }else{
                OrderItem::create(array_merge($request->except('_token'),['pro_id'=>$id,'order_id'=>$_COOKIE['order']]));
            }

            return redirect()->route('product',$product->cat_id);

        }catch (\Exception $ex) {
            return redirect()->route('home');
        }
    }

    public function addOrderByajax(Request $request)
    {
        try {
            $id = $request -> id;

            //Check cookies
            if(!isset($_COOKIE['order'])){
                return ['cookies' => "0"];
            }

            //Check product
            $product = Product::find($id);
            if (!$product) {
                return ['product' => '0'];
            }

            //check before add
            $item = OrderItem::where(['pro_id'=>$id,'order_id'=>$_COOKIE['order']])->first();
            if($item) {
                $item->update(['pro_amount'=> $item->pro_amount + 1]);
            }else{
                $item = OrderItem::create(array_merge([
                    'pro_id'=>$id,
                    'order_id'=>$_COOKIE['order'],
                    'pro_amount'=>1,
                    'notes'=>null,
                ]));
            }

            $order = new Orders();

            return [
                'success'=>  $item->pro_amount,
                'allItems'=> $order->culcContItem($_COOKIE['order']),
                'costItems'=>$order->culcCostItem($_COOKIE['order']),
            ];

        }catch (\Exception $ex) {
            return ['error'=>1];
        }
    }

    public function removeItemOrder(Request $request)
    {
        if(isset($request->id)){
            //Check item
            $item = OrderItem::find($request->id);
            if (!$item) {
                return ['item' => '0'];
            }else{
                $item->delete();
                $order = new Orders();
                return [
                    'success' => '1',
                    'costItems'=>$order->culcCostItem($_COOKIE['order']),
                ];
            }
        }
    }

    public function numItemOrder(Request $request)
    {
        if(isset($request->id) && isset($request->type)){
            //Check item
            $item = OrderItem::find($request->id);
            if (!$item) {
                return ['item' => '0'];
            }else{
                if($request->type == "p")
                    $item->update(['pro_amount'=> $item->pro_amount + 1]);
                if($request->type == "m")
                    $item->update(['pro_amount'=> $item->pro_amount - 1]);
                $order = new Orders();
                return [
                    'success' => '1',
                    'costItems'=>$order->culcCostItem($_COOKIE['order']),
                ];
            }
        }
    }

    public function checkPromoCode(Request $request)
    {
        if(isset($request->promocode) && isset($_COOKIE['order'])){
            //Check work promo
            $promo = new PromoCode();
            $order = new Orders();
            $promo->checkWork();
            //check
            $myorder = Orders::find($_COOKIE['order']);
            $promoCode=PromoCode::select()->where('code',$request->promocode)->first();
            if ($myorder && $promoCode) {
                $totalCost = $order->culcCostItem($_COOKIE['order']);
                $discount = $totalCost / $promoCode->value;
                $costAfterCode = $totalCost - $discount;
                $myorder->update(['promo_id'=>$promoCode->id,'total_cost'=>$costAfterCode]);
                return [
                    'success' => '1',
                    'totalCost2'=>$totalCost,
                    'discountCost'=>$discount,
                    'costItems'=>$costAfterCode,
                    'value'=>$promoCode->value,
                ];
            }else{
                return ['order' => '0'];
            }
        }
    }

    public function removePromoCode(Request $request)
    {
        if(isset($_COOKIE['order'])){
            //Check work promo
            $order = new Orders();
            //check
            $myorder = Orders::find($_COOKIE['order']);
            if ($myorder) {
                $totalCost = $order->culcCostItem($_COOKIE['order']);
                $myorder->update(['promo_id'=>null ,'total_cost'=>$totalCost]);
                return [
                    'success' => '1',
                    'costItems'=>$totalCost,
                ];
            }else{
                return ['order' => '0'];
            }
        }
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
                        'emarhName_ar' => $emarh->name_ar,
                        'areas' => $areas,
                    ];
                }
            }
        }
        $myOrder=null;
        if(isset($_COOKIE['order'])) {
            $myOrder = Orders::select()->find($_COOKIE['order']);
        }
        return view('front.delivery',compact('data','myOrder'));
    }

    public function setlocation(Request $request)
    {
        if(!isset($_COOKIE['order'])) {
            // check first
            $order= Orders::where(['phone'=>$request->phone,'state'=>'0'])->first();
            if(!$order){
                $request->merge([
                    'phone' => $request->phone,
                ]);
                $order = Orders::create($request->except(['_token']));
                setcookie('order', $order->id, time() * ( 60));  //365 * 24 * 60 * 60
            }else{
                $order->update(['area_id'=> $request->area_id]);
                setcookie('order', $order->id, time() * ( 60));
            }
            return redirect()->route('home');
        }else{
            $myOrder = Orders::find($_COOKIE['order']);
            $myOrder->update($request->except('_token'));
        }
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
        $this->orderComplet($_COOKIE['order']);
        $order = Orders::find($_COOKIE['order']);
        if($order){
            $promoCode = null;
            if($order->promo_id){
                $promoCode=PromoCode::find($order->promo_id);
            }
            $items = OrderItem::where('order_id',$order->id)->get();
            if ($items->count()==0)
                $empty = 1;

            return view('front.cart',compact('empty','order','items','promoCode'));
        }else{
            $empty = 1;
            return view('front.cart',compact('empty'));
        }


    }

    public function orderComplet($id)
    {
        $order = new Orders();
        $isOrder = $order->find($id);
        if($isOrder){
            $totalCost = $order->culcCostItem($id);
            if($isOrder->promo_id){
                $promoCode = PromoCode::find($isOrder->promo_id);
                $totalCost = $totalCost - ($totalCost / $promoCode->value);
            }
            $data=[
                'total_cost'=>$totalCost,
                'time'=>$order->culcTimeDelivery($isOrder->area_id ),
            ];
            $isOrder->update($data);
        }else{
            unset($_COOKIE['order']);
            setcookie('order', null, -1, '/');
        }
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
        return redirect()->route('otpview');
    }

    public function otpview()
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
            return view('front.otpview');
        }catch (\Exception $ex){
            return view('front.otpview');
        }

    }

    public function otpCheck(Request $request)
    {
        if(isset($_COOKIE['order'])){
            $order = new Orders();
            $isOrder = $order->find($_COOKIE['order']);
            if($request->otp == $isOrder->otp){
                $isOrder->update(['otp_check'=>1]);
                return redirect()->route('credit')->with(['success' => __('msg.thank for confirm')]);
            }else{
                return redirect()->route('otpview')->with(['error' => __('msg.Not same OTP code')]);
            }

        }
    }

    public function credit()
    {
        if(!isset($_COOKIE['order'])){
            return redirect()->route('cart');
        }
        // normal view
        $order = new Orders();
        $isOrder = $order->find($_COOKIE['order']);
        $paymentMessage = false;

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


        return view('front.credit',compact('isOrder'));
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
        $body = "نشكر لكم اختياركم بسكوتي ,تم تأكيد طلبكم , رقم ";
        $body .=$isOrder->id;
        $body .=" بقيمة ";
        $body .=$isOrder->total_cost;
        $body .=" AED ";
        try {
            $this->sendMessage($body, $recipient);
            if (isset($_COOKIE['order'])) {
                unset($_COOKIE['order']);
                setcookie('order', null, -1, '/');
            }
            return view('front.thankspage');
        }catch (\Exception $ex){
            return view('front.thankspage')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }

    }

    private function sendMessage($message, $recipients)
    {
        $recipients = "+971".$recipients;
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }

    public function checkorder()
    {
        return view('front.checkorder');
    }

    public function checkorderp(Request $request)
    {
        $order = new Orders();
        $isOrder = $order->find($request->id);
        if($isOrder){
            return redirect()->route('check.order')->with(
                ['success' => $order->getOrderState($isOrder->state)]);
        }else{
            return redirect()->route('check.order')->with(['error' => __('msg.Not Found')]);
        }
    }

    public function lang($lang)
    {
        if(session()->has('lang')){
            session()->forget('lang');
        }

        if (in_array($lang, ['en', 'ar'])) {
            session()->put('lang',$lang);
        }else{
            session()->put('lang','en');
        }
        App::setLocale('ar');
        return redirect()->route('home');
    }

    public function branches()
    {
        return view('front.branches');
    }

    public function search()
    {
        $products = Product::select()->active()->get();
        return view('front.search',compact('products'));
    }

}
