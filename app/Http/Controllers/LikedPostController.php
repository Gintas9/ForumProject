<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\LikedPost;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
class LikedPostController extends Controller
{
    public static function store(Post $post){
        $user=Auth::user();
        if(!self::isPostLiked($post)) {
            $likedPost = new LikedPost();
            $likedPost->uid = $user->id;
            $likedPost->pid = $post->id;
            $likedPost->save();
        }
        $posts=Post::where('tid','=',$post->tid)->orderByDesc('created_at')->get();

        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $users=User::all();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }
    public static function destroy(Post $post){
        $user=Auth::user();

        if(self::isPostLiked($post)) {
            $follower = LikedPost::where('uid', $user->id)->where('pid', $post->id)->delete();
        }
        $posts=Post::where('tid','=',$post->tid)->orderByDesc('created_at')->get();

        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $users=User::all();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }

    public static function storehome(Post $post){
        $user=Auth::user();
        if(!self::isPostLiked($post)) {
            $likedPost = new LikedPost();
            $likedPost->uid = $user->id;
            $likedPost->pid = $post->id;
            $likedPost->save();
        }


        $posts=Post::select('*')->join('followers','followers.tid','=','posts.tid'
        )->where('followers.uid','=',$user->id)->paginate(5);

        //    $coms=DB::table('comments')->join('posts','comments.pid','=',
        //       'posts.id')->where('posts.tid','=',$theme->id)->delete();
        $themes=Theme::get();
        // $posts=Post::orderByDesc('created_at')->get();

        return view('home')->withThemes($themes)->withPosts($posts);}


    public static function destroyhome(Post $post){
        $user=Auth::user();

        if(self::isPostLiked($post)) {
            $follower = LikedPost::where('uid', $user->id)->where('pid', $post->id)->delete();
        }


        $posts=Post::select('*')->join('followers','followers.tid','=','posts.tid'
        )->where('followers.uid','=',$user->id)->paginate(5);

        $themes=Theme::get();


        return view('home')->withThemes($themes)->withPosts($posts);
    }





    Public static function isPostLiked(Post $post)
    {
        $user=Auth::user();

       $liked=DB::table('liked_posts')->where('uid',$user->id)->where('pid',$post->id)->count();
        if($liked==0){
            return false;
        }
        else{
            return true;

        }
    }
    Public static function postLikeCount(Post $post){
        $user=Auth::user();

        $liked=DB::table('liked_posts')->where('pid',$post->id)->count();

            return $liked;


    }


}
