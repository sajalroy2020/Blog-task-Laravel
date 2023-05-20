<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Replay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'post_id',
        'comment',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function replayes(){
        return $this->hasMany(Replay::class);
    }
}
