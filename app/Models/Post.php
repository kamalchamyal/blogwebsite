<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'c_id',
        'post_title',
        'post_Description',
        'slug',
        'post_img',
        'banner_img'
    ];
    // public function category(){
    //     return $this->belongsTo(Category::class, 'c_name');
    //  }
    public function category(){
        return $this->belongsTo(Category::class,'c_name');
     }
}
