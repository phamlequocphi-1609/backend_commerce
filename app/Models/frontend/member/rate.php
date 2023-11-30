<?php

namespace App\Models\frontend\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    use HasFactory;
    protected $table = 'rate';
    public $timestamp = true;
    protected $fillable = ['id_user', 'id_blog', 'rate'];
}
