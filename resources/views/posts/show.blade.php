@extends('layouts.app')
@section('title', $post->title)

@section('content')
<div class="container" style="max-width:780px;">

    {{-- BACK --}}
    <a href="{{ route('posts.index') }}"
       style="display:inline-flex;align-items:center;gap:6px;color:#9ca3af;font-size:0.85rem;font-weight:500;text-decoration:none;margin-bottom:2rem;transition:color 0.2s;"
       onmouseover="this.style.color='#6c3bff'" onmouseout="this.style.color='#9ca3af'">
        <i class="bi bi-arrow-left"></i> Back to posts
    </a>

    {{-- ARTICLE HEADER --}}
    <div style="background:linear-gradient(135deg,#f5f0ff,#fce7f3);border-radius:20px;padding:2.5rem;margin-bottom:2rem;">
        <div class="tag-pill mb-3">✦ Article</div>
        <h1 style="font-family:'Syne',sans-serif;font-size:clamp(1.8rem,4vw,2.6rem);font-weight:800;line-height:1.2;letter-spacing:-0.5px;color:#0d0d1a;margin-bottom:1.5rem;">
            {{ $post->title }}
        </h1>

        <div class="d-flex align-items-center gap-3 flex-wrap">
            <a href="{{ route('users.show', $post->user) }}" style="text-decoration:none;flex-shrink:0;">
                <img src="{{ $post->user->avatar_url }}"
                     alt="Profile picture of {{ $post->user->name }}"
                     style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2.5px solid rgba(108,59,255,0.5);transition:border-color 0.2s;"
                     onmouseover="this.style.borderColor='#6c3bff'" onmouseout="this.style.borderColor='rgba(108,59,255,0.5)'">
            </a>
            <div>
                <a href="{{ route('users.show', $post->user) }}"
                   style="font-weight:600;font-size:0.9rem;color:#1a1a2e;text-decoration:none;transition:color 0.2s;"
                   onmouseover="this.style.color='#6c3bff'" onmouseout="this.style.color='#1a1a2e'">
                    {{ $post->user->name }}
                </a>
                <div style="font-size:0.78rem;color:#9ca3af;">
                    <i class="bi bi-calendar3 me-1"></i>{{ $post->created_at->format('M d, Y') }}
                    &nbsp;&middot;&nbsp;
                    <i class="bi bi-clock me-1"></i>{{ max(1, (int)(str_word_count($post->body) / 200)) }} min read
                </div>
            </div>

            @auth
                @if(Auth::id() === $post->user_id)
                    <div class="d-flex gap-2 ms-auto">
                        <a href="{{ route('posts.edit', $post) }}" class="btn-ghost-dark" style="padding:0.4rem 1rem;font-size:0.82rem;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                              onsubmit="return confirm('Delete this post permanently?')">
                            @csrf @method('DELETE')
                            <button class="btn-danger-soft" style="padding:0.4rem 1rem;font-size:0.82rem;">
                                <i class="bi bi-trash3"></i> Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- ARTICLE BODY --}}
    <div class="card-modern p-4 p-md-5" style="border-radius:20px;">
        <div class="post-body-content">{{ $post->body }}</div>
    </div>

    {{-- AUTHOR CARD --}}
    <a href="{{ route('users.show', $post->user) }}" style="text-decoration:none;display:block;">
        <div class="card-modern mt-4 p-4" style="border-radius:16px;background:linear-gradient(135deg,#0d0d1a,#1a1a2e);transition:transform 0.2s,box-shadow 0.2s;"
             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 12px 35px rgba(108,59,255,0.2)'"
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $post->user->avatar_url }}"
                     alt="Profile picture of {{ $post->user->name }}"
                     style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2.5px solid rgba(108,59,255,0.5);flex-shrink:0;">
                <div>
                    <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:1px;font-weight:600;">Written by</div>
                    <div style="font-family:'Syne',sans-serif;font-weight:700;color:#fff;font-size:1rem;">{{ $post->user->name }}</div>
                    @if($post->user->about)
                        <div style="font-size:0.78rem;color:rgba(255,255,255,0.4);margin-top:0.25rem;">
                            {{ Str::limit($post->user->about, 80) }}
                        </div>
                    @endif
                </div>
                <div style="margin-left:auto;color:rgba(255,255,255,0.25);font-size:0.8rem;">
                    View profile <i class="bi bi-arrow-right"></i>
                </div>
            </div>
        </div>
    </a>

</div>
@endsection
