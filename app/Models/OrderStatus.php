<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderStatus extends Model
{
    use Notifiable;
    protected $table = 'order_status';

    protected $guarded = [];

}
