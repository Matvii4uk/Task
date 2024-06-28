<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambler extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'phonenumber'];
}
