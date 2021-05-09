<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Theme;
use App\Models\Post;
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
        $posts=Post::where('tid','=',$theme->id)->orderByDesc('created_at')->get();

        return view('themes.show',['topic'=>$theme->topicname])->withUser($user)->withTheme($theme)->withPosts($posts);
    }
    public function create(){

        $user=Auth::user();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.create')->withUser($user);
    }
    public function store(Request $request){

        $this->validate($request,array(
            'topicname' =>'required|unique:themes,topicname|max:100|min:5',
            'description' => 'required|max:255'
        ));

        $user=Auth::user();
        $theme = new Theme();
        $theme->topicname=$request->input("topicname");
        $theme->description=$request->input("description");
        $theme->owner=$user->id;
        $theme->save();
        return redirect()->route('themes.index')->withMessage("Vlad Central");
    }

    public function edit(Theme $theme)
    {
        $user=Auth::user();
        return view('themes.edit')->withTheme($theme)->withUser($user);
    }

    public function update(Request $request, Theme $theme)
    {
        $this->validate($request,array(
            'topicname' =>'required|unique:themes,topicname|max:100|min:5',
            'description' => 'required|max:255'
        ));
        $theme->topicname=$request->topicname;
        $theme->description=$request->description;
        $theme->save();
        $user=Auth::user();

        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);
        $posts=Post::where('tid','=',$theme->id)->orderByDesc('created_at')->get();

        return view('themes.show',['topic'=>$theme->topicname])->withUser($user)->withTheme($theme)->withPosts($posts);

    }

    public function destroy(Theme $theme)
    {

        $mods=DB::table('mods')->where('tid',$theme->id)->delete();
       $coms=DB::table('comments')->join('posts','comments.pid','=',
       'posts.id')->where('posts.tid','=',$theme->id)->delete();
        $posts=DB::table('posts')->where('tid','=',$theme->id)->delete();
       $theme=Theme::find($theme->id)->delete();


        $user=Auth::user();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);
        return redirect()->route('themes.index')->withUser($user)->withThemes($themes)->withMessage('Theme Deleted');
    }


}
