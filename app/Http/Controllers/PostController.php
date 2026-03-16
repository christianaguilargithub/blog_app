<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        Auth::user()->posts()->create($request->only('title', 'body'));

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post->update($request->only('title', 'body'));

        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }
}
