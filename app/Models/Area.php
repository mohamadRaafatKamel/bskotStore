<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'emarh_id', 'estimated_time', 'disabled', 'updated_at','created_at'
    ];

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query){

        return $query -> select('id','name_ar', 'name_en', 'emarh_id', 'estimated_time', 'disabled', 'created_at');
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getEmarh()
    {
        $emarh = Emarh::select('name_ar')->find($this -> emarh_id );
        return $emarh['name_ar'];
    }

}
