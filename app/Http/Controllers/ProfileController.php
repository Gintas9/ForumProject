<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Theme;
use App\Models\Post;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $themes=Theme::where('owner','=',$id)->get();
        $posts=Post::where('uid', '=', $id)->get();
        $comments=Comment::where('uid', '=', $id)->get();
        $user=User::find($id);
        return view('Profile.show')->withUser($user)->withThemes($themes)->withPosts($posts)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        return view('Profile.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request,array(
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ));
  

        $user=User::find($id);
        $user -> email = request('email');
        $user -> password = bcrypt(request('password'));
     
        $user->save();

        return view('Profile.show')->withUser($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id)->delete();
        $posts=Post::where('uid','=',$id)->delete();
        $comments=Comment::where('uid','=',$id)->delete();
        $themes=Theme::where('owner','=',$id)->delete();
        

        return view('welcome');
    }

    //function to get number of topics created by user
    public static function getTcreated($id)
    {
      $themes=Theme::where('owner','=',$id)->count();
      return $themes;
    }

    //function to get number of posts created by user
    public static function getPcreated($id)
    {
        $posts=Post::where('uid','=',$id)->count();
      return $posts;
    }

    //function to get number of topics followed by user
    public static function getFTopic($id)
    {
        $foll=Follower::where('uid','=',$id)->count();
        return $foll;
    }

    //function to get number of users following current user
    public static function getTFoll($id)
    {
        $themes=Theme::where('owner','=',$id)->get();
        $followers=Follower::where('tid','=', 1)->count();

       // return $followers;
        return 3;
    }

    public static function getTName($id)
    {
        $themeN=Theme::find($id);
       
        return $themeN->topicname;
    }

    public static function getPTitle($id)
    {
        $post=Post::find($id);
       
        return $post->title;
    }


}
