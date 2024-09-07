<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about_u extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'destination',
        'image',
        'page_description',
    ];
    public $timestamps = false;
}
