@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

{{-- HERO --}}
<section style="background: linear-gradient(135deg, #0d0d1a 0%, #1a1a2e 60%, #2d1b69 100%); padding: 5rem 0 4rem;">
    <div class="container text-center">
        <div class="tag-pill mb-3">✦ Creative Blog</div>
        <h1 style="font-family:'Syne',sans-serif; font-size:clamp(2.2rem,5vw,3.8rem); font-weight:800; color:#fff; line-height:1.15; letter-spacing:-1px;">
            Ideas Worth <span class="gradient-text">Reading</span>
        </h1>
        <p style="color:rgba(255,255,255,0.55); font-size:1.05rem; max-width:480px; margin:1rem auto 2rem;">
            Discover stories, insights and perspectives from our community of writers.
        </p>
        @auth
            <a href="{{ route('posts.create') }}" class="btn-primary-grad" style="font-size:0.95rem; padding:0.75rem 2rem;">
                <i class="bi bi-pencil-square"></i> Write a Post
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-primary-grad" style="font-size:0.95rem; padding:0.75rem 2rem;">
                <i class="bi bi-rocket-takeoff"></i> Start Writing
            </a>
        @endauth
    </div>
</section>

{{-- POSTS GRID --}}
<div class="container" style="margin-top:-2rem;">

    @forelse($posts as $post)

        @if($loop->first)
        {{-- FEATURED FIRST POST --}}
        <div class="card-modern mb-4 p-0" style="background: linear-gradient(135deg,#f5f0ff,#fce7f3);">
            <div class="row g-0 align-items-center">
                <div class="col-md-8 p-4 p-md-5">
                    <div class="tag-pill mb-3">✦ Featured</div>
                    <h2 style="font-family:'Syne',sans-serif; font-size:1.9rem; font-weight:800; letter-spacing:-0.5px; line-height:1.25;">
                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p style="color:#6b7280; margin:0.75rem 0 1.25rem; line-height:1.7;">
                        {{ Str::limit($post->body, 180) }}
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#6c3bff,#ec4899);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.85rem;">
                            {{ strtoupper(substr($post->user->name,0,1)) }}
                        </div>
                        <div>
                            <div style="font-size:0.82rem;font-weight:600;color:#1a1a2e;">{{ $post->user->name }}</div>
                            <div style="font-size:0.75rem;color:#9ca3af;">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('posts.show', $post) }}" class="btn-primary-grad ms-auto" style="padding:0.5rem 1.2rem;font-size:0.85rem;">
                            Read <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-flex align-items-center justify-content-center p-4">
                    <div style="width:160px;height:160px;border-radius:50%;background:linear-gradient(135deg,#6c3bff,#a855f7,#ec4899);opacity:0.15;"></div>
                </div>
            </div>
        </div>

        {{-- GRID HEADER --}}
        @if($posts->count() > 1)
        <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
            <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;letter-spacing:0.5px;text-transform:uppercase;color:#9ca3af;">
                All Posts
            </h5>
            <span style="font-size:0.8rem;color:#9ca3af;">{{ $posts->total() }} articles</span>
        </div>
        <div class="row g-3">
        @endif

        @else
        {{-- REGULAR CARD --}}
        <div class="col-md-6 col-lg-4">
            <div class="card-modern h-100 p-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#6c3bff,#ec4899);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.75rem;flex-shrink:0;">
                        {{ strtoupper(substr($post->user->name,0,1)) }}
                    </div>
                    <div>
                        <div style="font-size:0.78rem;font-weight:600;color:#1a1a2e;">{{ $post->user->name }}</div>
                        <div style="font-size:0.7rem;color:#9ca3af;">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.05rem;line-height:1.35;margin-bottom:0.6rem;">
                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                        {{ $post->title }}
                    </a>
                </h5>

                <p style="font-size:0.875rem;color:#6b7280;line-height:1.65;flex-grow:1;margin-bottom:1.25rem;">
                    {{ Str::limit($post->body, 110) }}
                </p>

                <a href="{{ route('posts.show', $post) }}"
                   style="font-size:0.82rem;font-weight:600;color:#6c3bff;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                    Read more <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        @endif

    @empty
        <div class="text-center py-5 mt-4">
            <div style="font-size:3.5rem;margin-bottom:1rem;">✍️</div>
            <h4 style="font-family:'Syne',sans-serif;font-weight:700;">No posts yet</h4>
            <p style="color:#9ca3af;">Be the first to share something great.</p>
            @auth
                <a href="{{ route('posts.create') }}" class="btn-primary-grad mt-2">Write the first post</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary-grad mt-2">Join & Write</a>
            @endauth
        </div>
    @endforelse

    @if($posts->count() > 1)
        </div>{{-- end row --}}
    @endif

    {{-- PAGINATION --}}
    @if($posts->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $posts->links() }}
        </div>
    @endif

</div>
@endsection
