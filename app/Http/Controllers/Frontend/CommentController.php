<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Contracts\MediaServiceInterface;

class CommentController extends Controller
{
    protected $mediaService;

    public function __construct(MediaServiceInterface $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index(){
        $comments = Comment::orderBy('id','desc')->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'media' => 'nullable|image|max:2048',
        ]);

        try {
            $comment = Comment::create([
                'post_id' => $post->id,
                'content' => $request->input('content'),
            ]);

            if ($request->hasFile('media')) {
                $this->mediaService->upload($comment, $request->file('media'));
            }

            return redirect()->back()->with('success', 'Comment posted successfully!');
        } catch (\Exception $e) {
            \Log::info('Comment Store Error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

}
