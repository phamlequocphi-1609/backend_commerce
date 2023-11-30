<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BlogRate extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'rate';

    public $timestamp = true;

    protected $fillable = ['id_user', 'id_blog', 'rate'];
}
