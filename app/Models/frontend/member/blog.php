<?php

namespace App\Models\frontend\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    public $timestamp = true;
    protected $fillable = ['title', 'image', 'description', 'content'];

    public function comment(){
        return $this->hasMany('App\Models\frontend\member\comment', 'id_blog');
    }
}
