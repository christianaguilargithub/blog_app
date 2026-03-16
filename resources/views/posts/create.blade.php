@extends('layouts.app')
@section('title', 'New Post')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card p-4">
            <h4 class="fw-bold mb-4">Write a New Post</h4>

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required autofocus>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Content</label>
                    <textarea name="body" rows="10" class="form-control @error('body') is-invalid @enderror"
                              required>{{ old('body') }}</textarea>
                    @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark">Publish</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
