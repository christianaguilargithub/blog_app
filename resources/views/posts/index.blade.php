@extends('layouts.app')
@section('title', 'All Posts')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Latest Posts</h4>
            @auth
                <a href="{{ route('posts.create') }}" class="btn btn-dark btn-sm">+ New Post</a>
            @endauth
        </div>

        @forelse($posts as $post)
            <div class="card mb-3 p-3">
                <h5 class="fw-semibold mb-1">
                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                        {{ $post->title }}
                    </a>
                </h5>
                <p class="text-muted small mb-2">
                    By {{ $post->user->name }} &middot; {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mb-0 text-secondary">{{ Str::limit($post->body, 150) }}</p>
            </div>
        @empty
            <div class="text-center text-muted py-5">
                <p>No posts yet. Be the first to write one!</p>
                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-dark">Write a Post</a>
                @endauth
            </div>
        @endforelse

        <div class="mt-3">{{ $posts->links() }}</div>
    </div>
</div>
@endsection
