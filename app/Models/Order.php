<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'quantity',
        'sub_total',
        'service_fee',
        'delivery_fee',
        'discount',
        'total',
        'promo_id',
        'order_status',
        'stripe_token',
        'transaction_id'
    ];

    protected $appends = [
        'user_detail'
    ];


    public function orderproduct() {
        return $this->hasMany('App\Models\OrderProduct')->latest();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function promos() {
        return $this->belongsTo('App\Models\Promos', 'promo_id', 'id');
    }
   
      
    
     public function getUserDetailAttribute(){
        return User::select('id','name','email','username','user_type')->where('id',$this->user_id )->first();
    }
}
