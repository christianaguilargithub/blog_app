@extends('layouts.app')
@section('title', 'Create Account')

@section('content')
<div class="container" style="max-width:900px;">
    <div class="card-modern overflow-hidden" style="border-radius:24px;min-height:540px;">
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
                        Join the<br>community. ✦
                    </h3>
                    <p style="color:rgba(255,255,255,0.45);font-size:0.875rem;line-height:1.7;">
                        Create your free account and start sharing ideas, stories and insights with readers worldwide.
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
                <div class="tag-pill mb-3">✦ New Account</div>
                <h4 style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;margin-bottom:0.25rem;">
                    Create your account
                </h4>
                <p style="color:#9ca3af;font-size:0.875rem;margin-bottom:2rem;">
                    Free forever. No credit card required.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-modern">Full Name</label>
                        <input type="text" name="name"
                               class="form-control-modern w-100 @error('name') is-invalid @enderror"
                               placeholder="John Doe"
                               value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Email Address</label>
                        <input type="email" name="email"
                               class="form-control-modern w-100 @error('email') is-invalid @enderror"
                               placeholder="you@example.com"
                               value="{{ old('email') }}" required>
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
                               placeholder="Min. 6 characters" required>
                        @error('password')
                            <div style="color:#ef4444;font-size:0.8rem;margin-top:0.35rem;">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-modern">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control-modern w-100"
                               placeholder="Repeat password" required>
                    </div>

                    <button type="submit" class="btn-primary-grad w-100" style="justify-content:center;padding:0.75rem;">
                        <i class="bi bi-rocket-takeoff"></i> Create Account
                    </button>
                </form>

                <p style="text-align:center;margin-top:1.5rem;font-size:0.85rem;color:#9ca3af;margin-bottom:0;">
                    Already have an account?
                    <a href="{{ route('login') }}" style="color:#6c3bff;font-weight:600;text-decoration:none;">
                        Sign in
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
