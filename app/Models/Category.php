<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_name',
        'category_image',
        'is_publish'
    ];

    public function items() {
        return $this->hasMany('App\Models\Item', 'category_id', 'id');
    }
     public function getCategoryImageAttribute() {
        if($this->attributes['category_image'] == "") {
            return null;
        }
        return url('/uploads/categories/'.$this->attributes['category_image']);
    }

    
}
