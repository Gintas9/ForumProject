<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Follower;

use App\Models\Mod;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PagesController extends Controller
{

//select * from posts p join followers f where f.tid=p.tid and f.uid=2;
    public function gotoMainPage()
    {
        $user=Auth::user();
        $query =
            //select * from posts p join followers
            // f where f.tid=p.tid and f.uid='.$user->id.';';
   //     $p=DB::raw($query);
     //   $posts=Post::fromQuery($p);
        $posts=Post::select('*')->join('followers','followers.tid','=','posts.tid'
        )->where('followers.uid','=',$user->id)->paginate(5);

    //    $coms=DB::table('comments')->join('posts','comments.pid','=',
     //       'posts.id')->where('posts.tid','=',$theme->id)->delete();
        $themes=Theme::get();
       // $posts=Post::orderByDesc('created_at')->get();

        return view('home')->withThemes($themes)->withPosts($posts);
    }
    public static function AnyPosts(){
        $user=Auth::user();
        $query ='select * from posts p join followers f where f.tid=p.tid and f.uid='.$user->id.';';
        $p=DB::raw($query);
        $posts=Post::fromQuery($p)->count();
        $themes=Theme::get();

        if($posts==0){
            return false;
        }
        else{
            return true;
        }

    }
}
