<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowerController extends Controller
{
        public function cdFollower(Theme $theme){
            $user=Auth::user();

            if(self::isFollower($theme->id,$user->id)){

              self::MakeFollower($theme->id,$user->id);
              //  $follower = new Follower();
              //  $follower->uid=$user->id;
             //   $follower->tid=$theme->id;
              //  $follower->save();
           }else{

                self::DeleteFollower($theme->id,$user->id);

           }
          //  $users=User::all();
           // $themes=Theme::all();
            $posts=Post::where('tid','=',$theme->id)->orderByDesc('created_at')->get();

            return redirect()->route('themes.show',$theme)->withUser($user)->withTheme($theme)->withPosts($posts);



        }
    public static function MakeFollower(Theme $theme){
        $user=Auth::user();
        $follower = new Follower();
        $follower->uid=$user->id;
        $follower->tid=$theme->id;
        $follower->save();
        $posts=Post::where('tid','=',$theme->id)->orderByDesc('created_at')->get();

        return redirect()->route('themes.show',$theme)->withUser($user)->withTheme($theme)->withPosts($posts);



    }

    public static function DeleteFollower(Theme $theme){
        $user=Auth::user();
        $follower=Follower::where('uid',$user->id)->where('tid',$theme->id)->delete();
        $posts=Post::where('tid','=',$theme->id)->orderByDesc('created_at')->get();

        return redirect()->route('themes.show',$theme)->withUser($user)->withTheme($theme)->withPosts($posts);


    }



    Public static function isFollower(Theme $theme)
    {
        $user=Auth::user();
        $follower=Follower::where('uid',$user->id)->where('tid',$theme->id)->count();
        if($follower==0){
            return false;
        }
        else{
            return true;

        }
    }

    public static function followerCount(Theme $theme){

            $count=Follower::where('tid',$theme->id)->count();
            return $count;
    }
}
