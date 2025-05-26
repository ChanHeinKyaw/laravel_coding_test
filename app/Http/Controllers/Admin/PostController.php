<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\Contracts\MediaServiceInterface;

class PostController extends Controller
{
    protected $mediaService;

    public function __construct(MediaServiceInterface $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(){
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request){
        try {
            $post = Post::create($request->only('title', 'content'));

            if ($request->hasFile('media')) {
                $this->mediaService->upload($post, $request->file('media'));
            }

            return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            \Log::error('Post Store Error: '.$e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function edit($id)
    {
        $post = Post::with('media')->findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($request->only('title', 'content'));

            if ($request->hasFile('media')) {
                $this->mediaService->upload($post, $request->file('media'));
            }

            return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Post Update Error: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);

            $this->mediaService->delete($post);
            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Post Delete Error: '.$e->getMessage());
            return redirect()->route('posts.index')->with('error', 'Failed to delete post.');
        }
    }
}
