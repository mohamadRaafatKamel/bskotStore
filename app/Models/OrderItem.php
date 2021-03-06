<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'pro_id', 'pro_amount', 'notes', 'state', 'updated_at','created_at'
    ];

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query){

        return $query -> select('id', 'order_id', 'pro_id', 'pro_amount', 'notes', 'state', 'updated_at','created_at');
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

}
