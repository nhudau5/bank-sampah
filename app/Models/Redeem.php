<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $fillable = [
        'user_id',
        'redeem_reward_id',
        'points_used',
        'status'
    ];

    public function reward()
    {
        return $this->belongsTo(RedeemReward::class, 'redeem_reward_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
