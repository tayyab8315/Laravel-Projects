<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class website_properties_card extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'title',
        'Description',
    ];
        // Disable timestamps if not needed
        public $timestamps = false;
}
