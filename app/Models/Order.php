<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin', 'destination', 'order_type', 'user_id', 'cost', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
