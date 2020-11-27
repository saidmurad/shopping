<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deliveryLocation extends Model
{
    protected $fillable = ['phoneNumber' ,'address', 'addressDetail' , 'order_id' ];

    public function order()
    {
        return $this->belongsTo('App\order');
    }

}
