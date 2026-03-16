@extends('layouts.app')
@section('title', 'New Post')

@section('content')
<div class="container" style="max-width:760px;">

    {{-- PAGE HEADER --}}
    <div class="text-center mb-4">
        <div class="tag-pill mb-2">✦ New Article</div>
        <h2 style="font-family:'Syne',sans-serif;font-weight:800;font-size:2rem;letter-spacing:-0.5px;">
            Write Something <span class="gradient-text">Great</span>
        </h2>
        <p style="color:#9ca3af;font-size:0.9rem;">Share your ideas with the world</p>
    </div>

    <div class="card-modern p-4 p-md-5" style="border-radius:20px;">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label-modern">Post Title</label>
                <input type="text" name="title"
                       class="form-control-modern w-100 @error('title') is-invalid @enderror"
                       placeholder="Enter a compelling title..."
                       value="{{ old('title') }}" required autofocus>
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
                          placeholder="Tell your story..." required>{{ old('body') }}</textarea>
                @error('body')
                    <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div style="border-top:1px solid #e5e7eb;padding-top:1.5rem;display:flex;gap:0.75rem;align-items:center;">
                <button type="submit" class="btn-primary-grad">
                    <i class="bi bi-send"></i> Publish Post
                </button>
                <a href="{{ route('posts.index') }}" class="btn-ghost-dark">
                    <i class="bi bi-x-lg"></i> Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
