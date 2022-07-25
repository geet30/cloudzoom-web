<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Item extends Model
{
    use HasFactory;use SoftDeletes;
     protected $fillable = [
        'item_name',
        'description',
        'item_image',
        'category_id',
        'price',
        'is_featured',
        'favourite',

    ];
     protected $appends = [
            
            'item_image',
            'category',
            'is_favourite'
           
    ];

     public function getIsFavouriteAttribute()
    {
        $fav= FavouriteItem::select('item_id')->where(['item_id'=>$this->id,'user_id'=>auth()->user()->id])->first();
        if(isset($fav['item_id'])){
            return 1;
        }else{
            return 0;
        }

    }

    public function category() {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function getItemImageAttribute() {
        if($this->attributes['item_image'] == "") {
            return null;
        }
        return url('/uploads/items/'.$this->attributes['item_image']);
    }

    public function getCategoryAttribute(){
        return Category::select(['id','category_name','category_image'])->where('id',$this->category_id )->first();
    }
   
}
