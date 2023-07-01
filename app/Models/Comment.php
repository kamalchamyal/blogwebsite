<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'comment', 'parent_id','Comment_status','post_id'];

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
