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
        $user=Auth::user();
        $isCreator=DB::table('themes')->where('id','=',$tid)->where('owner','=',$user->id)->count();
        if($isCreator==0){
            return false;
        }else{
            return true;
        }
    }

    public function store(Request $request)
    {

        $mod=new Mod();

        $mod->uid=$request->input('uid');
        $mod->tid=$request->input('tid');
        $mod->level=1;
        $mod->save();

        $user=Auth::user();

        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);
        return view('themes.index')->withThemes($themes)->withUser($user);


    }

    public static function getUsersMods($tid){
        $user=Auth::user();
        $query='select * from mods where tid='.$tid;
        $p=DB::raw($query);
        $users=User::fromQuery($p);
        return $users;
    }
    public static function getUserName($uid){

        $query='select * from users where id='.$uid;
        $p=DB::raw($query);
        $user=User::fromQuery($p);
        return $user->name;


    }
}
