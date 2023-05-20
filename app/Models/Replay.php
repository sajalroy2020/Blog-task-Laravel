<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Replay extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'replay',
    ];

    public function comment(){
        return $this->belongsTo(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


