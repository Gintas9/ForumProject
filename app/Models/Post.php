<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','text'];

    public static function hasPosts(){
        $query='select * from posts';
        $user=Auth::user();
        $p=DB::raw($query);
        $themes=Post::fromQuery($p)->count();
        if ($themes==0) {
            return false;
        }else{
            return true;
        }
    }

    public static function getPost($id){

        $post=Post::find($id);

        return $post;

    }
}
