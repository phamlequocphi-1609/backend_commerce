<?php

namespace App\Models\frontend\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamp = true;
    protected $fillable = ['id_user', 'name','price', 'id_category', 'id_brand', 'status', 'sale','company', 'image', 'detail'];
}
