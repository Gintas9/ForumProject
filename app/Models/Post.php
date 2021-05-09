<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','text'];

    public static function hasPosts(){
        $query='select * from posts';
        $user=Auth::user();
        $p=DB::raw($query);
        $themes=Post::fromQuery($p)->count();
        if ($themes==0) {
            return false;
        }else{
            return true;
        }
    }

    public static function isPostLiked(Post $post){
        $user=Auth::user();
        $liked=Follower::where('uid',$user->id)->where('pid',$post->id)->count();
        if($liked==0){
            return false;
        }
        else{
            return true;

        }
    }

    public static function getPost($id){

        $post=Post::find($id);

        return $post;

    }
    public static function getUserByPost(Post $post){

        $usr=User::find($post->uid);

        return $usr;

    }
}
