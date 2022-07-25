<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteItem extends Model
{
    use HasFactory;

     protected $fillable = ['user_id','item_id'];
      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'item_id'
    ];


     public function item() {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }

   


}
