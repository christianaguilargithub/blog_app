@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
<div class="container" style="max-width:760px;">

    {{-- PAGE HEADER --}}
    <div class="text-center mb-4">
        <div class="tag-pill mb-2">✦ Editing</div>
        <h2 style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.5px;">
            Refine Your <span class="gradient-text">Story</span>
        </h2>
        <p style="color:#9ca3af;font-size:0.9rem;">Make it even better</p>
    </div>

    <div class="card-modern p-4 p-md-5" style="border-radius:20px;">
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label-modern">Post Title</label>
                <input type="text" name="title"
                       class="form-control-modern w-100 @error('title') is-invalid @enderror"
                       value="{{ old('title', $post->title) }}" required autofocus>
                @error('title')
                    <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-modern">Content</label>
                <textarea name="body" rows="14"
                          class="form-control-modern w-100 @error('body') is-invalid @enderror"
                          required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div style="border-top:1px solid #e5e7eb;padding-top:1.5rem;display:flex;gap:0.75rem;align-items:center;">
                <button type="submit" class="btn-primary-grad">
                    <i class="bi bi-check-lg"></i> Update Post
                </button>
                <a href="{{ route('posts.show', $post) }}" class="btn-ghost-dark">
                    <i class="bi bi-x-lg"></i> Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
