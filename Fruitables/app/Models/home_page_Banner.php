<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class home_page_Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'Banner_image',
        'Banner_Title',
        'Banner_Desc',
    ];
        // Disable timestamps if not needed
        public $timestamps = false;

}
