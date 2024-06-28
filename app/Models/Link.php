<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['gambler_id', 'slug', 'expires_at'];

    public static function createLink($gamblerId)
    {
        $dataLink = [
            'gambler_id' => $gamblerId,
            'slug' => self::getSlug(),
            'expires_at' => Carbon::now()->addDay(7)->format('Y-m-d H:i:s')
        ];

        return Link::create($dataLink);
    }

    private static function getSlug()
    {
        return base_convert(time(), 10, 36);
    }
}
