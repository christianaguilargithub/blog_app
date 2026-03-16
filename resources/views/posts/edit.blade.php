@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card p-4">
            <h4 class="fw-bold mb-4">Edit Post</h4>

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $post->title) }}" required autofocus>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Content</label>
                    <textarea name="body" rows="10" class="form-control @error('body') is-invalid @enderror"
                              required>{{ old('body', $post->body) }}</textarea>
                    @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
