<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id', 'name_ar', 'name_en', 'img', 'price', 'cat_id', 'notes_ar', 'notes_en', 'disabled', 'updated_at','created_at'
    ];

    public function scopeActive($query)
    {
        return $query -> where('disabled',0);
    }

    public function  scopeSelection($query)
    {

        return $query -> select('id', 'name_ar', 'name_en', 'img', 'price', 'cat_id', 'notes_ar', 'notes_en', 'disabled', 'updated_at','created_at');
    }

    public function getActive()
    {
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getCategory()
    {
        $cat = Category::select('name_ar')->find($this -> cat_id );
        return $cat['name_ar'];
    }

    public static function getNameById($id)
    {
        $cat = Product::find($id);
        return $cat['name_en'];
    }

    public static function getPriceById($id)
    {
        $cat = Product::find($id);
        return $cat['price'];
    }

}
