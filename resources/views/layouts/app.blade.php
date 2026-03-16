<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — @yield('title', 'Blog')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #6c3bff;
            --primary-light: #8b5cf6;
            --accent: #ff6b6b;
            --accent2: #ffd93d;
            --dark: #0d0d1a;
            --dark2: #1a1a2e;
            --surface: #ffffff;
            --surface2: #f7f7fc;
            --text: #1a1a2e;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --gradient: linear-gradient(135deg, #6c3bff 0%, #a855f7 50%, #ec4899 100%);
            --gradient-soft: linear-gradient(135deg, #f0ebff 0%, #fce7f3 100%);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--surface2);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .site-nav {
            background: rgba(13, 13, 26, 0.97);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-brand {
            font-family: 'Syne', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-brand span {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
            margin-left: 3px;
            vertical-align: super;
        }

        .nav-link-item {
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-link-item:hover {
            color: #fff !important;
            background: rgba(255,255,255,0.08);
        }

        .nav-user-badge {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
            padding: 0.3rem 0.75rem;
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .btn-nav-primary {
            background: var(--gradient);
            color: #fff !important;
            border: none;
            padding: 0.45rem 1.1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-nav-primary:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        .btn-nav-ghost {
            background: transparent;
            color: rgba(255,255,255,0.7) !important;
            border: 1px solid rgba(255,255,255,0.18);
            padding: 0.42rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-nav-ghost:hover {
            background: rgba(255,255,255,0.08);
            color: #fff !important;
            border-color: rgba(255,255,255,0.3);
        }

        /* ── FLASH ── */
        .flash-wrap {
            position: fixed;
            top: 80px;
            right: 1.5rem;
            z-index: 9999;
            min-width: 300px;
        }

        .flash-alert {
            background: #fff;
            border-left: 4px solid #10b981;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 0.9rem 1.2rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── BUTTONS ── */
        .btn-primary-grad {
            background: var(--gradient);
            color: #fff;
            border: none;
            padding: 0.65rem 1.6rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .btn-primary-grad:hover {
            opacity: 0.88;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 59, 255, 0.35);
            color: #fff;
        }

        .btn-ghost-dark {
            background: transparent;
            color: var(--text-muted);
            border: 1.5px solid var(--border);
            padding: 0.63rem 1.4rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .btn-ghost-dark:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #f5f0ff;
        }

        .btn-danger-soft {
            background: #fff0f0;
            color: #ef4444;
            border: 1.5px solid #fecaca;
            padding: 0.63rem 1.4rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-danger-soft:hover {
            background: #ef4444;
            color: #fff;
            border-color: #ef4444;
        }

        /* ── CARDS ── */
        .card-modern {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            transition: transform 0.25s, box-shadow 0.25s, border-color 0.25s;
            overflow: hidden;
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(108, 59, 255, 0.1);
            border-color: rgba(108, 59, 255, 0.2);
        }

        /* ── FORM CONTROLS ── */
        .form-control-modern {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fafafa;
            color: var(--text);
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(108, 59, 255, 0.1);
            background: #fff;
            outline: none;
        }

        .form-control-modern.is-invalid {
            border-color: #ef4444;
        }

        .form-label-modern {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text);
            letter-spacing: 0.3px;
            margin-bottom: 0.4rem;
            text-transform: uppercase;
        }

        /* ── FOOTER ── */
        .site-footer {
            background: var(--dark);
            color: rgba(255,255,255,0.35);
            text-align: center;
            padding: 2rem 0;
            font-size: 0.8rem;
            margin-top: 5rem;
        }

        .site-footer a {
            color: rgba(255,255,255,0.5);
            text-decoration: none;
        }

        /* ── UTILITIES ── */
        .gradient-text {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tag-pill {
            display: inline-block;
            background: var(--gradient-soft);
            color: var(--primary);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .post-body-content {
            white-space: pre-wrap;
            line-height: 1.85;
            font-size: 1.05rem;
            color: #374151;
        }

        .page-wrap {
            min-height: calc(100vh - 64px);
            padding: 2.5rem 0 4rem;
        }

        /* ── PAGINATION ── */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: 1.5px solid var(--border);
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background: var(--gradient);
            border-color: transparent;
        }

        .pagination .page-link:hover {
            background: var(--gradient-soft);
            color: var(--primary);
            border-color: rgba(108,59,255,0.2);
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="site-nav">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="nav-brand" href="{{ route('posts.index') }}">
                INKSPACE<span></span>
            </a>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="nav-user-badge">
                        <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                    </span>
                    <a href="{{ route('posts.create') }}" class="btn-nav-primary">
                        <i class="bi bi-plus-lg"></i> Write
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline m-0">
                        @csrf
                        <button class="btn-nav-ghost">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link-item">Sign in</a>
                    <a href="{{ route('register') }}" class="btn-nav-primary">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="flash-wrap" id="flashMsg">
            <div class="flash-alert">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                {{ session('success') }}
                <button onclick="document.getElementById('flashMsg').remove()"
                        style="margin-left:auto;background:none;border:none;cursor:pointer;color:#9ca3af;font-size:1rem;">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>
        <script>setTimeout(()=>{const el=document.getElementById('flashMsg');if(el)el.remove();},4000);</script>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="page-wrap">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="container">
            <span class="gradient-text fw-bold" style="font-family:'Syne',sans-serif;">INKSPACE</span>
            &nbsp;&mdash;&nbsp; A space for ideas &nbsp;&middot;&nbsp;
            Built with <span style="color:#ff6b6b;">♥</span> on Laravel
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
