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

       if($theme->blocked == 0)
        {
         $theme->blocked=1;
        }
        else {$theme->blocked=0;}
      //  $theme->update($theme->blocked);
        $theme->update();
        $theme->save();
        $users=User::all();
        $themes=Theme::all();

       //return redirect(Request::url());
        return redirect()->route('superuser')->withThemes($themes)->withUsers($users);
        //return redirect()->action([HomeController::class, 'index']);
     //  return view('superuser.super')->withThemes($themes)->withUsers($users);
    }

    public static function isTblock(Theme $theme)
    {
        if($theme->block == 0){
            return "No";}
        else {return "Yes";}
    }


}
