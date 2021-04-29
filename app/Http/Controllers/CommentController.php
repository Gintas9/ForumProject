<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Theme;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
   // private $query='select * from posts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'text' => 'required'
        ));
        $comment = new Comment();
        $comment->pid=$request->input('pid');
        $comment->uid=Auth::id();
        $comment->text=$request->input('text');
        $comment->save();

        $post = Post::find($request->input('pid'));
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $comments=Comment::where('pid', '=', $post->id)->get();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $user=User::find($comment->uid);
        $post=Post::find($comment->pid);

        return view('Comments.show')->withUser($user)->withPost($post)->withComment($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $user=Auth::user();
        return view('Comments.edit')->withComment($comment)->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());
        $comment->save();

        $post=Post::find($comment->pid);
        $users=User::all();
        $user=Auth::user();
        $theme=Theme::find($post->tid);
        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();

        return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $post=Post::find($comment->pid);
        $user=Auth::user();
        $users=User::all();
        $theme=Theme::find($post->tid);
        $comments=Comment::where('pid', '=', $post->id)->orderByDesc('created_at')->get();

        $deletePost=Comment::find($comment->id)->delete();

       return view('Posts.show')->withPost($post)->withUser($user)->withTheme($theme)->withComments($comments)->withUsers($users);

    }

    public static function getName($uid)
    {
        $user=User::find($uid);
        return $user->name;
    }
}
