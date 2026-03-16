@extends('layouts.app')
@section('title', 'Sign In')

@section('content')
<div class="container" style="max-width:900px;">
    <div class="card-modern overflow-hidden" style="border-radius:24px;min-height:480px;">
        <div class="row g-0 h-100">

            {{-- LEFT PANEL --}}
            <div class="col-md-5 d-none d-md-flex flex-column justify-content-between p-5"
                 style="background:linear-gradient(160deg,#0d0d1a 0%,#2d1b69 100%);">
                <div>
                    <div style="font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;background:linear-gradient(135deg,#6c3bff,#a855f7,#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        INKSPACE
                    </div>
                </div>
                <div>
                    <h3 style="font-family:'Syne',sans-serif;font-weight:800;color:#fff;font-size:1.6rem;line-height:1.3;margin-bottom:1rem;">
                        Welcome<br>back. ✦
                    </h3>
                    <p style="color:rgba(255,255,255,0.45);font-size:0.875rem;line-height:1.7;">
                        Sign in to continue writing, editing and sharing your stories with the world.
                    </p>
                </div>
                <div style="display:flex;gap:8px;">
                    <div style="width:8px;height:8px;border-radius:50%;background:#6c3bff;"></div>
                    <div style="width:8px;height:8px;border-radius:50%;background:#a855f7;"></div>
                    <div style="width:8px;height:8px;border-radius:50%;background:#ec4899;"></div>
                </div>
            </div>

            {{-- RIGHT PANEL --}}
            <div class="col-md-7 p-4 p-md-5 d-flex flex-column justify-content-center">
                <div class="tag-pill mb-3">✦ Sign In</div>
                <h4 style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;margin-bottom:0.25rem;">
                    Good to see you
                </h4>
                <p style="color:#9ca3af;font-size:0.875rem;margin-bottom:2rem;">
                    Enter your credentials to access your account
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-modern">Email Address</label>
                        <input type="email" name="email"
                               class="form-control-modern w-100 @error('email') is-invalid @enderror"
                               placeholder="you@example.com"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Password</label>
                        <input type="password" name="password"
                               class="form-control-modern w-100 @error('password') is-invalid @enderror"
                               placeholder="••••••••" required>
                        @error('password')
                            <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex align-items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                               style="width:16px;height:16px;accent-color:#6c3bff;cursor:pointer;">
                        <label for="remember" style="font-size:0.85rem;color:#6b7280;cursor:pointer;margin:0;">
                            Keep me signed in
                        </label>
                    </div>

                    <button type="submit" class="btn-primary-grad w-100" style="justify-content:center;padding:0.75rem;">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </button>
                </form>

                <p style="text-align:center;margin-top:1.5rem;font-size:0.85rem;color:#9ca3af;margin-bottom:0;">
                    No account yet?
                    <a href="{{ route('register') }}" style="color:#6c3bff;font-weight:600;text-decoration:none;">
                        Create one free
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
