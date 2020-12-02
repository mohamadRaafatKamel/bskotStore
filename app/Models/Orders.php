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
        'id', 'name', 'phone', 'area_id', 'time', 'pay_way', 'total_cost', 'promo_id', 'state', 'updated_at','created_at'
    ];

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query){

        return $query -> select('id', 'name', 'phone', 'area_id', 'time', 'pay_way', 'total_cost', 'promo_id', 'state', 'disabled', 'created_at');
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

}
