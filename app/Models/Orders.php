<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'phone', 'area_id', 'delivery_adress', 'time', 'pay_way', 'total_cost',
        'bank_transaction_id', 'otp', 'otp_check', 'promo_id', 'state', 'updated_at','created_at'
    ];

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'phone', 'area_id', 'delivery_adress', 'time',
            'pay_way', 'total_cost', 'otp', 'otp_check', 'promo_id', 'state', 'bank_transaction_id', 'disabled', 'created_at');
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public static function getCode($id){
        $promo = PromoCode::find($id);
        return $promo->code;
    }

    public static function culcCostItem ($id)
    {
        $items = OrderItem::where('order_id',$id)->get();
        $totalPrice = 0;
        if($items){
            foreach ($items as $item){
                $product = Product::find($item->pro_id);
                $totalPrice += $item->pro_amount * $product->price ;
            }
        }
        return $totalPrice;
    }

    public static function culcContItem ($id)
    {
        $items = OrderItem::where('order_id',$id)->get();
        $total = 0;
        if($items){
            foreach ($items as $item){
                $total += $item->pro_amount;
            }
        }
        return $total;
    }

    public function culcTimeDelivery($id)
    {
        $area = Area::find($id);
        return $area-> estimated_time;
    }

    public function getOrderState($state)
    {
        switch ($state){
            case 0:
                return "في انتظار الدفع";
                break;
            case 1:
                return "تم الدفع و جاري تجهيز الطلب";
                break;
            case 2:
                return "جاري التجهيز الطلب و الدفع عند الاستلام";
                break;
            case 3:
                return "جاري توصبل الطلب";
                break;
            case 4:
                return "تم تسليم الطلب";
                break;
        }
    }

    public function getAreaName($id)
    {
        $area = Area::select('name_ar')->find($id);
        return $area['name_ar'];
    }

    public function getpaymentWay($state)
    {
        switch ($state){
            case 1:
                return "كريكيت كارت";
                break;
            case 2:
                return "كاش";
                break;
        }
    }

    public function getDeliveryPrice($id)//id aria
    {
        $area = Area::select('emarh_id')->find($id);
        $emarh= Emarh::find($area['emarh_id']);
        return $emarh['price'];
    }


}
