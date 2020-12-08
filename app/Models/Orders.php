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
        'id', 'name', 'phone', 'area_id', 'delivery_adress', 'time', 'pay_way', 'total_cost', 'promo_id', 'state', 'updated_at','created_at'
    ];

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'phone', 'area_id', 'delivery_adress', 'time', 'pay_way', 'total_cost', 'promo_id', 'state', 'disabled', 'created_at');
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function culcCostItem ($id)
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

    public function culcTimeDelivery($id){
        $area = Area::find($id);
        return $area-> estimated_time;
    }

}
