<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'subject',
        'is_viewed',
        'is_active',
        'is_answered',
        'user_id',
        'manager_id',
        'shortcode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}
