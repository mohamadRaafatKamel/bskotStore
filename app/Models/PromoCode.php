<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $table = 'promo_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'code', 'limit_date', 'type', 'value', 'disabled', 'updated_at','created_at'
    ];

    public function scopeActive($query)
    {
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query)
    {
        return $query -> select('id', 'code', 'limit_date', 'type', 'value', 'disabled', 'updated_at','created_at');
    }

    public function getActive()
    {
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function checkWork()
    {
        $codes = PromoCode::select()->active()->get();
        foreach ($codes as $code){
            if(Carbon::parse($code->limit_date)->isPast()){
                $code->update(['disabled'=>'1']);
            }
        }
    }

}
