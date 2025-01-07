<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderCancelReason extends Model
{
    use Notifiable;
    protected $table = 'order_cancel_reason';

    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
