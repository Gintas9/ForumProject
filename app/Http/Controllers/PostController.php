<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Theme;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $query='select * from themes';
//	id 	tid 	created_at 	updated_at 	title 	text 	photo
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title' =>'required|max:255|min:5',
            'text' => 'required'
        ));
        $post=new Post();
        $post->title=$request->input('title');
        $post->text=$request->input('text');
        $post->uid=$request->input('uid');
        $post->tid=$request->input('tid');
        $post->photo="";
        $post->save();
        // $theme=Theme::find($post->tid);
        $user=Auth::user();

        $theme=Theme::find($request->input('tid'));
        $posts=Post::where('tid','=',$request->input('tid'))->orderByDesc('created_at')->get();
        return view('themes.show',['topic'=>$theme->topicname])->withUser($user)->withTheme($theme)->withPosts($posts);

    }





    public function index(){


    }

    public function destroy(Post $post)
    {
        $post=Post::find($post->id);
        $user=Auth::user();
        $deletePost=Post::find($post->id)->delete();
        $deleteComment=Comment::where('pid',$post->id)->delete();
        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.index')->withThemes($themes)->withUser($user);


    }
    public function show(Post $post)
    {
        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $users=User::all();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }
    public function edit(Post $post)
    {
        $user=Auth::user();
        return view('Posts.edit')->withPost($post)->withUser($user);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request,array(
            'title' =>'required|max:255|min:5',
            'text' => 'required'
        ));
        $user=Auth::user();

        $post->update($request->all());


        $post->save();

        $p=DB::raw($this->query);
        $themes=Theme::fromQuery($p);

        return view('themes.index')->withThemes($themes)->withUser($user);

    }

}
