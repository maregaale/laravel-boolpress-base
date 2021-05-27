<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    public function index ()
    {
        // dati
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->get();
        $tags = Tag::all();

        // return
        return view('guest.posts.index', compact('posts', 'tags'));
    }

    public function showPost ($slug)
    {
        // dati
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();

        // controllo 
        if ( $post == null ) {
            abort(404);
        }

        // return
        return view('guest.posts.show', compact('post', 'tags'));
    }
}
