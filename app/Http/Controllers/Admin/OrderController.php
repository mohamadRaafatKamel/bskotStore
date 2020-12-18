<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use App\Models\Emarh;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use App\Models\PromoCode;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::select()->where('state','2')->paginate(PAGINATION_COUNT);
        return view('admin.order.index', compact('orders'));
    }

    public function sending()
    {
        $orders = Orders::select()->where('state','3')->paginate(PAGINATION_COUNT);
        return view('admin.order.sending', compact('orders'));
    }

    public function done()
    {
        $orders = Orders::select()->where('state','4')->paginate(PAGINATION_COUNT);
        return view('admin.order.done', compact('orders'));
    }

    public function view($id)
    {
        $order = Orders::find($id);
        $items = OrderItem::select()->where('order_id',$id)->get();
        $promoCode= null;
        if($order->promo_id){
            $promoCode = PromoCode::find($order->promo_id);
        }
        return view('admin.order.view', compact('order','items','promoCode'));
    }

    public function viewSending($id)
    {
        try {
            $order = Orders::find($id);
            if (!$order) {
                return redirect()->route('admin.order', $id)->with(['error' => '  غير موجوده']);
            }

            $order->update(['state'=>'3']);

            $recipient = $order->phone;
            $body = "جاري توصيل طلبك رقم ";
            $body .=$order->id;
            $body .=" بقيمة ";
            $body .=$order->total_cost;
            $body .=" AED ";
            $body .=" من فضلك تواجد في العنوان ";
            $body .=$order->delivery_adress;
            $body .=" خلال الساعات القادمة ";
            $this->sendMessage($body, $recipient);
            return redirect()->route('admin.order.view',$id)->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.order.view',$id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function viewDone($id)
    {
        try {
            $order = Orders::find($id);
            if (!$order) {
                return redirect()->route('admin.order', $id)->with(['error' => '  غير موجوده']);
            }

            $recipient = $order->phone;
            $body = " تم تسليم طلبكم رقم ";
            $body .=$order->id;
            $body .=" نشكر لكم ثقتكم ببسكوتي ونتطلع لنيل شرف خدمتكم مرة أخرى. ";
            $this->sendMessage($body, $recipient);

            $order->update(['state'=>'4']);

            return redirect()->route('admin.order.view',$id)->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.order.view',$id)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
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

}
