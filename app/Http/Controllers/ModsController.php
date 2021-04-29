<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Theme;
use App\Models\Mod;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModsController extends Controller
{
    private $query='select * from themes';
    public static function isUserCreator($tid){
        //checks if user is theme creator
        $user=Auth::user();
        $isCreator=DB::table('themes')->where('id','=',$tid)->where('owner','=',$user->id)->count();
        if($isCreator==0){
            return false;
        }else{
            return true;
        }
    }
    public static function isUserPostCreator($pid,$uid){
        //checks if user is post creator

        $isCreator=DB::table('posts')->where('id','=',$pid)->where('uid','=',$uid)->count();
        if($isCreator==0){
            return false;
        }else{
            return true;
        }
    }
    public static function isUserThemeCreator($tid,$uid){
        $user=Auth::user();
        $isCreator=DB::table('themes')->where('id','=',$tid)->where('owner','=',$user->id)->count();
        if($isCreator==0){
            return false;
        }else{
            return true;
        }
    }

    public static function isUserMod($tid){
        $user=Auth::user();

        $isCreator=DB::table('mods')->where('tid','=',$tid)->where('uid','=',$user->id)->count();
        if($isCreator==0){
            return false;
        }else{
            return true;
        }
    }


    public function store(Request $request)
    {
        $user=Auth::user();
        $mod=new Mod();
        $isMod=DB::table('mods')->where('tid','=',$request->input('tid'))->where('uid','=',$request->input('uid'))->count();
        $p = DB::raw($this->query);
        $themes = Theme::fromQuery($p);
        //check for duplicates
        if($isMod == 0) {
            $mod->uid = $request->input('uid');
            $mod->tid = $request->input('tid');
            $mod->level = $request->input('level');;
            $mod->save();

        }
        return view('themes.index')->withThemes($themes)->withUser($user);
            }

    public static function getUsersMods($tid){
        //gets users that are mods of tid
        $user=Auth::user();
        $query='select * from mods where tid='.$tid;
        $p=DB::raw($query);
        $users=User::fromQuery($p);
        return $users;
    }

    public static function getUsersForMods($tid){
        //gets users that are mods of tid
        $user=Auth::user();
        $query='select * from users';
        $p=DB::raw($query);
        $users=User::fromQuery($p);
        return $users;
    }

    public static function getUserName($uid){


        $user=User::find($uid);
        return $user->name;


    }
    public function destroy(Mod $mod)
    {

        $user=Auth::user();
        $deleteMod=Mod::table()->where('uid','=',$mod->uid)->where('tid','=',$mod->tid)->delete();

        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.index')->withThemes($themes)->withUser($user);


    }
    //gets Mod object
    public static function getMod($uid,$tid){

        //$mod=Mod::where('uid','=',$uid)->where('tid','=',$tid)->first();
        $mod=DB::table('mods')->where('uid',$uid)->where('tid',$tid)->first();
        $mo=$mod;
       return $mo;

    }
}
