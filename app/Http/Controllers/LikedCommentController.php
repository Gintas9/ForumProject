<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikedComment;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikedCommentController extends Controller
{
    public static function store(Post $post,Comment $comment){
        $user=Auth::user();
        if(!self::isCommentLiked($comment)) {
            $likedPost = new LikedComment();
            $likedPost->uid = $user->id;
            $likedPost->cid = $comment->id;
            $likedPost->save();
        }
        $posts=Post::where('tid','=',$post->tid)->orderByDesc('created_at')->get();

        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $users=User::all();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }
    public static function destroy(Post $post,Comment $comment){
        $user=Auth::user();

        if(self::isCommentLiked($comment)) {
            $follower = LikedComment::where('uid', $user->id)->where('cid', $comment->id)->delete();
        }

        $posts=Post::where('tid','=',$post->tid)->orderByDesc('created_at')->get();

        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $users=User::all();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }

    public static function storeshow(Post $post,Comment $comment){
        $user=User::find($comment->uid);
        if(!self::isCommentLiked($comment)) {
            $likedPost = new LikedComment();
            $likedPost->uid = $user->id;
            $likedPost->cid = $comment->id;
            $likedPost->save();
        }


        $post=Post::find($comment->pid);

        return view('Comments.show')->withUser($user)->withPost($post)->withComment($comment);
    }
    public static function destroyshow(Post $post,Comment $comment){

        $user=User::find($comment->uid);
        if(self::isCommentLiked($comment)) {
            $follower = LikedComment::where('uid', $user->id)->where('cid', $comment->id)->delete();
        }

        $user=Auth::user();


        $post=Post::find($comment->pid);

        return view('Comments.show')->withUser($user)->withPost($post)->withComment($comment);
    }


    Public static function isCommentLiked(Comment $comment)
    {
        $user=Auth::user();

        $liked=DB::table('liked_comments')->where('uid',$user->id)->where('cid',$comment->id)->count();
        if($liked==0){
            return false;
        }
        else{
            return true;

        }
    }
    Public static function commentLikeCount(Comment $comment){
        $user=Auth::user();

        $liked=DB::table('liked_comments')->where('cid',$comment->id)->count();

        return $liked;


    }
}
