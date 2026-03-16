@extends('layouts.app')
@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <a href="{{ route('posts.index') }}" class="text-muted small d-inline-block mb-3">← Back to posts</a>

        <div class="card p-4">
            <h2 class="fw-bold mb-1">{{ $post->title }}</h2>
            <p class="text-muted small mb-4">
                By {{ $post->user->name }} &middot; {{ $post->created_at->format('M d, Y') }}
            </p>

            <div class="post-body text-secondary">{{ $post->body }}</div>

            @auth
                @if(Auth::id() === $post->user_id)
                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                              onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
