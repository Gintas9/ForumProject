<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Theme;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    private $query='select * from themes';

    public function index(){

        $user=Auth::user();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.index')->withThemes($themes)->withUser($user);
    }
    public function show(Theme $theme){

         $user=Auth::user();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.show',['topic'=>$theme->topicname])->withUser($user)->withTheme($theme);
    }
    public function create(){

        $user=Auth::user();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.create')->withUser($user);
    }
    public function store(Request $request){

        $user=Auth::user();
        $theme = new Theme();
        $theme->topicname=$request->input("topicname");
        $theme->description=$request->input("description");
        $theme->owner=$user->id;
        $theme->save();
        return redirect()->route('themes.index')->withMessage("Vlad Central");
    }




}
