<?php

namespace App\Models\frontend\member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public $timestamp = true;
    protected $fillable = ['comment', 'id_user', 'id_blog', 'name_user','avatar_user', 'level'];
}
