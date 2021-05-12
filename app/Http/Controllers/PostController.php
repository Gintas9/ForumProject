<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Theme;
use \Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\LikedPost;
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

    public function risingPost()
    {
        //$posts = Post::whereDate('created_at', Carbon::today())->get();
       // $liked=LikedPost::whereDate('created_at', Carbon::today())->get();
       $posts=Post::all();
       return view('Posts.rising')->withPosts($posts);
    }

    public static function numLikedToday()
    {
        $liked=LikedPost::whereDate('created_at', Carbon::today())->count();
        if($liked > 0)
            return true;
        else return false;
    }

    public static function mostLikedToday()
    {
        $count = 0;
        $bid = 0;
        $posts = Post::all();
        foreach($posts as $post)
            {
                $liked=LikedPost::where('pid','=', $post->id)->whereDate('created_at', Carbon::today())->count();
                if($liked > $count)
                    $bid = $post->id;
            }
    
        return $bid;
    }

    public static function getRisingTitle()
    {   
       return Post::find(PostController::mostLikedToday())->title;
    }
    public static function getRisingTopicName()
    {
       $tid = Post::find(PostController::mostLikedToday())->tid;
       return Theme::find($tid)->topicname;
    }
    public static function likeNum()
    {
       //$tid = Post::find(PostController::mostLikedToday())->tid;
       return LikedPost::where('pid','=',PostController::mostLikedToday())->count();
    }
    public static function getRisingOwner()
    {
      
       return User::find(Post::find(PostController::mostLikedToday())->uid)->name;
    }

}
