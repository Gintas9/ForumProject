<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Theme extends Model
{
    use HasFactory;

    public static function hasThemes(){
        $query='select * from themes';
        $user=Auth::user();
        $p=DB::raw($query);
        $themes=Theme::fromQuery($p)->count();
        if ($themes==0) {
            return false;
        }else{
            return true;
        }
    }

    public static function getTheme($id){

        $theme=Theme::find($id);

        return $theme;

    }

    public static function isUserThemeCreator(Theme $theme){
        $user=Auth::user();
        if($user->id==$theme->owner){
            return true;
        }else{
            return false;
        }


    }





}
