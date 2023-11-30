<?php

namespace App\Models\frontend\category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';
    public $timestamp = true;
    protected $fillable = ['category'];
}
