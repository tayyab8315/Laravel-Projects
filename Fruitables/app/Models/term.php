<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class term extends Model
{
    use HasFactory;
    protected $fillable = ['terms_conditions'];

    public $timestamps = false;

}
