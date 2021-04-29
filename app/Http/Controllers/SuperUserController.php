<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuperUserController extends Controller
{
    public function superScreen(){

   /* $users=User::where('blocked', '=', '1')->get();
    $themes=Theme::where('blocked', '=', '1')->get();*/
    $users=User::all();
    $themes=Theme::all();
    return view('superuser.super')->withThemes($themes)->withUsers($users);
    }

     public static function tblock(Theme $theme)
    {

       if($theme->blocked)
        {
         $theme->blocked = false;
        }
        else {$theme->blocked = true;}
        $theme->update();
        $theme->save();
        $users=User::all();
        $themes=Theme::all();

        return redirect()->route('superuser')->withThemes($themes)->withUsers($users);
    }

    public static function ublock(User $user)
    {

       if($user->blocked)
        {
         $user->blocked = false;
        }
        else {$user->blocked = true;}
        $user->update();
        $user->save();
        $users=User::all();
        $themes=Theme::all();

        return redirect()->route('superuser')->withThemes($themes)->withUsers($users);
    }

    


}
