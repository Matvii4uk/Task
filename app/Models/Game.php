<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['gambler_id', 'score', 'message', 'amount'];

    public static function play($gamblerId)
    {
        $score = rand(1, 1000);

        $result = ['score'=>$score, 'gambler_id' => $gamblerId];

        if ($score % 2) {
            $result['message'] = 'Lose';
            $result['amount'] = 0;
        } else {
            $result['message'] = 'Win';
            $result['amount'] = Game::getAmount($score);
        }

        return $result;
    }

    public static function getAmount($score)
    {
        if ($score > 900) {
            $amount = $score * 0.7;
        } elseif ($score > 600) {
            $amount = $score * 0.5;
        } elseif ($score > 300) {
            $amount = $score * 0.3;
        } else {
            $amount = $score * 0.1;
        }

        return round($amount,2);
    }

}
