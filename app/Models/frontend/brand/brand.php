<?php

namespace App\Models\frontend\brand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    protected $table = 'brand';
    public $timestamp = true;
    protected $fillable = ['brand'];
}
