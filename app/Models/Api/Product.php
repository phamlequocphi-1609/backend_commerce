<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public $timestamp = true;
    
    protected $fillable = ['id_user', 'name', 'price', 'id_category', 'id_brand', 'status', 'sale', 'company', 'image', 'detail'];

    public function Brand(){
        return $this->hasOne('App\Models\Api\Brand', 'id', 'id_brand');

    }
    public function Category(){
        return $this->hasOne('App\Models\Api\Category', 'id', 'id_category');

    }
}
