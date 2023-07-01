<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'c_name', 'c_slug','c_status'
    ];

    // public function posts(){
    //     return $this->belongsTo(Post::class, 'c_id', 'id','c_slug');
    // }
    public function posts(){
        return $this->hasMany(Post::class, 'c_id');
    }
    public function latestPost()
    {
        return $this->hasOne(Post::class, 'c_id')->latest();
    }

    public function twoPosts()
{
    return $this->hasMany(Post::class,'c_id')->limit(2);
}
}

