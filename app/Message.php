<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'text',
        'file',
        'claim_id',
        'user_id',
    ];

    public function claim()
    {
        $this->belongsTo(Claim::class);
    }
}
