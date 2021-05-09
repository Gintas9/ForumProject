<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
   protected $fillable = ['text'];

    public static function isCommentLiked(Comment $comment){
        $user=Auth::user();
        $liked=Follower::where('uid',$user->id)->where('pid',$comment->id)->count();
        if($liked==0){
            return false;
        }
        else{
            return true;

        }
    }
}
