<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

     protected $fillable = [
        'order_id',
        'product_id',
        'category_id',
        'quantity',
        'price'
    ];
    
    protected $appends = [
            'product_detail'
    ];

    public function getProductDetailAttribute()
    {
       
        return Item::where('id',$this->product_id )->first();
    }

  
    public function product() {
        return $this->hasMany('App\Models\Item','id','product_id');
    }

    public function order($value='')
    {
    	return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

}
