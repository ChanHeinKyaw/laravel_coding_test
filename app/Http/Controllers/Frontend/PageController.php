<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(){
        $posts = Post::with('media')->orderBy('id', 'desc')->paginate(10);

        return view('frontend.posts.index', compact('posts'));
    }

    public function show($id){
        $post = Post::findOrFail($id);

        return view('frontend.posts.show', compact('post'));
    }
}
