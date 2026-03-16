<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} — Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                        syne:  ['Syne', 'sans-serif'],
                    },
                    colors: {
                        primary: '#6c3bff',
                        accent:  '#ec4899',
                    },
                    backgroundImage: {
                        'grad-main':  'linear-gradient(135deg,#6c3bff 0%,#a855f7 50%,#ec4899 100%)',
                        'grad-dark':  'linear-gradient(160deg,#0d0d1a 0%,#2d1b69 100%)',
                        'grad-soft':  'linear-gradient(135deg,#f5f0ff 0%,#fce7f3 100%)',
                        'grad-card':  'linear-gradient(160deg,#1a1a2e 0%,#2d1b69 100%)',
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg,#6c3bff,#a855f7,#ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .avatar-ring {
            background: linear-gradient(135deg,#6c3bff,#a855f7,#ec4899);
            padding: 3px;
            border-radius: 9999px;
        }
        .post-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(108,59,255,0.25);
        }
        .post-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
        .btn-grad {
            background: linear-gradient(135deg,#6c3bff,#a855f7,#ec4899);
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-grad:hover { opacity: 0.85; transform: translateY(-2px); }
        .input-field {
            background: #0f0f1f;
            border: 1.5px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #e5e7eb;
            padding: 0.65rem 1rem;
            width: 100%;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .input-field:focus {
            border-color: #6c3bff;
            box-shadow: 0 0 0 3px rgba(108,59,255,0.15);
        }
        .input-field::placeholder { color: rgba(255,255,255,0.25); }
        .social-input-wrap { position: relative; }
        .social-input-wrap .social-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.3);
            font-size: 1rem;
            pointer-events: none;
        }
        .social-input-wrap .input-field { padding-left: 2.5rem; }
        .avatar-preview-wrap { position: relative; display: inline-block; }
        .avatar-preview-wrap label {
            position: absolute;
            bottom: 4px;
            right: 4px;
            background: linear-gradient(135deg,#6c3bff,#ec4899);
            border-radius: 9999px;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #0d0d1a;
            transition: transform 0.2s;
        }
        .avatar-preview-wrap label:hover { transform: scale(1.1); }
        .flash-toast {
            animation: slideDown 0.35s ease;
        }
        @keyframes slideDown {
            from { opacity:0; transform:translateY(-16px); }
            to   { opacity:1; transform:translateY(0); }
        }
        /* Navbar */
        .site-nav {
            background: rgba(13,13,26,0.97);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0.85rem 0;
        }
    </style>
</head>
<body class="bg-[#0d0d1a] text-gray-100 min-h-screen">

    {{-- ── NAVBAR ── --}}
    <nav class="site-nav">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between">
            <a href="{{ route('posts.index') }}"
               class="font-syne font-extrabold text-xl gradient-text tracking-tight">
                INKSPACE<span class="inline-block w-2 h-2 rounded-full bg-pink-500 ml-1 align-super text-xs"></span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('posts.index') }}"
                   class="text-white/50 hover:text-white text-sm font-medium transition-colors px-3 py-1.5 rounded-lg hover:bg-white/5">
                    <i class="bi bi-house me-1"></i> Home
                </a>
                @auth
                    <a href="{{ route('posts.create') }}"
                       class="btn-grad text-white text-sm font-semibold px-4 py-2 rounded-lg flex items-center gap-1.5 no-underline">
                        <i class="bi bi-plus-lg"></i> Write
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="text-white/50 hover:text-white border border-white/15 hover:border-white/30 text-sm font-medium px-3 py-1.5 rounded-lg transition-all bg-transparent cursor-pointer">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ── FLASH ── --}}
    @if(session('success'))
        <div class="flash-toast fixed top-20 right-4 z-50 bg-[#1a1a2e] border border-green-500/30 text-green-400 text-sm font-medium px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 max-w-sm"
             id="flashMsg">
            <i class="bi bi-check-circle-fill text-green-400 text-base"></i>
            {{ session('success') }}
            <button onclick="document.getElementById('flashMsg').remove()"
                    class="ml-auto text-white/30 hover:text-white/70 bg-transparent border-none cursor-pointer text-lg leading-none">
                &times;
            </button>
        </div>
        <script>setTimeout(()=>{const e=document.getElementById('flashMsg');if(e)e.remove();},4000);</script>
    @endif

    {{-- ── HERO BANNER ── --}}
    <section class="bg-grad-dark border-b border-white/5 py-14 px-4">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center sm:items-end gap-6">

            {{-- Avatar --}}
            <div class="avatar-preview-wrap flex-shrink-0">
                <div class="avatar-ring">
                    <img id="avatarPreview"
                         src="{{ $user->avatar_url }}"
                         alt="Profile picture of {{ $user->name }}"
                         class="w-28 h-28 sm:w-36 sm:h-36 rounded-full object-cover block">
                </div>
                @if(Auth::id() === $user->id)
                    <label for="avatarInput" title="Change profile picture">
                        <i class="bi bi-camera-fill text-white text-sm"></i>
                    </label>
                @endif
            </div>

            {{-- Name + meta --}}
            <div class="text-center sm:text-left flex-1">
                <h1 class="font-syne font-extrabold text-3xl sm:text-4xl text-white leading-tight tracking-tight">
                    {{ $user->name }}
                </h1>
                <p class="text-white/40 text-sm mt-1">{{ $user->email }}</p>

                {{-- Social links (display) --}}
                <div class="flex items-center justify-center sm:justify-start gap-3 mt-3 flex-wrap">
                    @if($user->twitter)
                        <a href="https://twitter.com/{{ ltrim($user->twitter,'@') }}"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="{{ $user->name }} on Twitter"
                           class="flex items-center gap-1.5 text-white/40 hover:text-[#1d9bf0] text-sm transition-colors">
                            <i class="bi bi-twitter-x text-base"></i>
                            <span class="hidden sm:inline">{{ $user->twitter }}</span>
                        </a>
                    @endif
                    @if($user->linkedin)
                        <a href="https://linkedin.com/in/{{ ltrim($user->linkedin,'/') }}"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="{{ $user->name }} on LinkedIn"
                           class="flex items-center gap-1.5 text-white/40 hover:text-[#0a66c2] text-sm transition-colors">
                            <i class="bi bi-linkedin text-base"></i>
                            <span class="hidden sm:inline">{{ $user->linkedin }}</span>
                        </a>
                    @endif
                    @if($user->instagram)
                        <a href="https://instagram.com/{{ ltrim($user->instagram,'@') }}"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="{{ $user->name }} on Instagram"
                           class="flex items-center gap-1.5 text-white/40 hover:text-pink-400 text-sm transition-colors">
                            <i class="bi bi-instagram text-base"></i>
                            <span class="hidden sm:inline">{{ $user->instagram }}</span>
                        </a>
                    @endif
                    @if(!$user->twitter && !$user->linkedin && !$user->instagram)
                        <span class="text-white/20 text-xs italic">No social links added yet</span>
                    @endif
                </div>
            </div>

            {{-- Stats --}}
            <div class="flex gap-6 sm:gap-8 text-center flex-shrink-0">
                <div>
                    <div class="font-syne font-extrabold text-2xl gradient-text">{{ $user->posts->count() }}</div>
                    <div class="text-white/35 text-xs uppercase tracking-widest mt-0.5">Posts</div>
                </div>
                <div>
                    <div class="font-syne font-extrabold text-2xl gradient-text">
                        {{ $user->created_at->format('Y') }}
                    </div>
                    <div class="text-white/35 text-xs uppercase tracking-widest mt-0.5">Joined</div>
                </div>
            </div>

        </div>
    </section>

    {{-- ── MAIN CONTENT ── --}}
    <main class="max-w-6xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── LEFT SIDEBAR ── --}}
            <aside class="lg:col-span-1 flex flex-col gap-6">

                {{-- About Me (read) --}}
                <section aria-label="About {{ $user->name }}"
                         class="bg-[#1a1a2e] border border-white/8 rounded-2xl p-5">
                    <h2 class="font-syne font-bold text-sm uppercase tracking-widest text-white/40 mb-3">
                        About Me
                    </h2>
                    <p class="text-white/70 text-sm leading-relaxed">
                        {{ $user->about ?? 'No bio added yet.' }}
                    </p>
                </section>

                {{-- Edit Profile Form (only own profile) --}}
                @if(Auth::id() === $user->id)
                <section aria-label="Edit profile"
                         class="bg-[#1a1a2e] border border-white/8 rounded-2xl p-5">

                    <h2 class="font-syne font-bold text-sm uppercase tracking-widest text-white/40 mb-4">
                        Edit Profile
                    </h2>

                    <form id="profileForm"
                          method="POST"
                          action="{{ route('profile.update') }}"
                          enctype="multipart/form-data"
                          novalidate>
                        @csrf

                        {{-- Avatar file input — inside the form so it submits with everything --}}
                        <input type="file"
                               id="avatarInput"
                               name="avatar"
                               accept="image/png,image/jpeg,image/webp"
                               class="hidden"
                               onchange="handleAvatarChange(event)">

                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name"
                                   class="block text-xs font-semibold text-white/40 uppercase tracking-wider mb-1.5">
                                Display Name
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="input-field @error('name') border-red-500 @enderror"
                                   placeholder="Your name">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- About --}}
                        <div class="mb-4">
                            <label for="about"
                                   class="block text-xs font-semibold text-white/40 uppercase tracking-wider mb-1.5">
                                About Me
                            </label>
                            <textarea id="about"
                                      name="about"
                                      rows="4"
                                      maxlength="1000"
                                      class="input-field @error('about') border-red-500 @enderror"
                                      placeholder="Tell the world about yourself...">{{ old('about', $user->about) }}</textarea>
                            @error('about')
                                <p class="text-red-400 text-xs mt-1">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Social Links --}}
                        <div class="mb-2">
                            <p class="text-xs font-semibold text-white/40 uppercase tracking-wider mb-3">
                                Social Links
                            </p>

                            <div class="flex flex-col gap-3">
                                {{-- Twitter --}}
                                <div class="social-input-wrap">
                                    <i class="bi bi-twitter-x social-icon"></i>
                                    <input type="text"
                                           name="twitter"
                                           value="{{ old('twitter', $user->twitter) }}"
                                           class="input-field @error('twitter') border-red-500 @enderror"
                                           placeholder="@username"
                                           aria-label="Twitter username">
                                    @error('twitter')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- LinkedIn --}}
                                <div class="social-input-wrap">
                                    <i class="bi bi-linkedin social-icon"></i>
                                    <input type="text"
                                           name="linkedin"
                                           value="{{ old('linkedin', $user->linkedin) }}"
                                           class="input-field @error('linkedin') border-red-500 @enderror"
                                           placeholder="linkedin.com/in/handle"
                                           aria-label="LinkedIn profile">
                                    @error('linkedin')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Instagram --}}
                                <div class="social-input-wrap">
                                    <i class="bi bi-instagram social-icon"></i>
                                    <input type="text"
                                           name="instagram"
                                           value="{{ old('instagram', $user->instagram) }}"
                                           class="input-field @error('instagram') border-red-500 @enderror"
                                           placeholder="@username"
                                           aria-label="Instagram username">
                                    @error('instagram')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-white/8">
                            <button type="submit"
                                    class="btn-grad w-full text-white font-semibold text-sm py-2.5 rounded-xl flex items-center justify-center gap-2 cursor-pointer border-none">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                        </div>

                    </form>
                </section>
                @endif

            </aside>

            {{-- ── RIGHT — POSTS GRID ── --}}
            <section aria-label="Posts by {{ $user->name }}"
                     class="lg:col-span-2">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-syne font-extrabold text-xl text-white">
                        Articles
                        <span class="text-white/25 font-inter font-normal text-base ml-2">
                            ({{ $user->posts->count() }})
                        </span>
                    </h2>
                    @if(Auth::id() === $user->id)
                        <a href="{{ route('posts.create') }}"
                           class="btn-grad text-white text-xs font-semibold px-4 py-2 rounded-lg flex items-center gap-1.5 no-underline">
                            <i class="bi bi-plus-lg"></i> New Post
                        </a>
                    @endif
                </div>

                @forelse($user->posts->sortByDesc('created_at') as $post)
                    <article class="post-card bg-grad-card border border-white/8 rounded-2xl p-5 mb-4 flex flex-col sm:flex-row sm:items-start gap-4">

                        {{-- Number badge --}}
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-white/5 border border-white/8 flex items-center justify-center font-syne font-bold text-white/30 text-sm">
                            {{ $loop->iteration }}
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="font-syne font-bold text-white text-base leading-snug mb-1 truncate">
                                <a href="{{ route('posts.show', $post) }}"
                                   class="hover:text-purple-300 transition-colors no-underline text-white">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-white/40 text-xs mb-3 leading-relaxed line-clamp-2">
                                {{ Str::limit($post->body, 120) }}
                            </p>
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="text-white/25 text-xs flex items-center gap-1">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                <span class="text-white/25 text-xs flex items-center gap-1">
                                    <i class="bi bi-clock"></i>
                                    {{ max(1,(int)(str_word_count($post->body)/200)) }} min read
                                </span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex sm:flex-col gap-2 flex-shrink-0">
                            <a href="{{ route('posts.show', $post) }}"
                               class="text-white/30 hover:text-purple-400 transition-colors text-sm px-3 py-1.5 rounded-lg border border-white/8 hover:border-purple-500/30 no-underline flex items-center gap-1">
                                <i class="bi bi-eye"></i>
                                <span class="hidden sm:inline text-xs">View</span>
                            </a>
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="text-white/30 hover:text-purple-400 transition-colors text-sm px-3 py-1.5 rounded-lg border border-white/8 hover:border-purple-500/30 no-underline flex items-center gap-1">
                                    <i class="bi bi-pencil"></i>
                                    <span class="hidden sm:inline text-xs">Edit</span>
                                </a>
                                <form method="POST"
                                      action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirm('Delete \'{{ addslashes($post->title) }}\'?')"
                                      class="m-0">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-white/30 hover:text-red-400 transition-colors text-sm px-3 py-1.5 rounded-lg border border-white/8 hover:border-red-500/30 bg-transparent cursor-pointer flex items-center gap-1 w-full">
                                        <i class="bi bi-trash3"></i>
                                        <span class="hidden sm:inline text-xs">Delete</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                    </article>
                @empty
                    <div class="text-center py-16 bg-[#1a1a2e] border border-white/8 rounded-2xl">
                        <div class="text-5xl mb-4">✍️</div>
                        <h3 class="font-syne font-bold text-white text-lg mb-2">No posts yet</h3>
                        <p class="text-white/35 text-sm mb-5">
                            {{ Auth::id() === $user->id ? 'Start writing your first article.' : 'This author hasn\'t published anything yet.' }}
                        </p>
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('posts.create') }}"
                               class="btn-grad text-white text-sm font-semibold px-6 py-2.5 rounded-xl inline-flex items-center gap-2 no-underline">
                                <i class="bi bi-pencil-square"></i> Write First Post
                            </a>
                        @endif
                    </div>
                @endforelse

            </section>

        </div>
    </main>

    {{-- ── FOOTER ── --}}
    <footer class="border-t border-white/5 py-8 text-center mt-10">
        <p class="text-white/20 text-xs">
            <span class="gradient-text font-syne font-bold">INKSPACE</span>
            &nbsp;&mdash;&nbsp; A space for ideas &nbsp;&middot;&nbsp;
            Built with <span class="text-pink-500">♥</span> on Laravel
        </p>
    </footer>

    <script>
        function handleAvatarChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(e) {
                // 1. Update BOTH avatar images instantly (hero + any other)
                document.querySelectorAll('#avatarPreview').forEach(img => {
                    img.src = e.target.result;
                });

                // 2. Show uploading state on the camera button
                const camBtn = document.querySelector('.avatar-preview-wrap label');
                if (camBtn) {
                    camBtn.innerHTML = '<i class="bi bi-arrow-repeat text-white text-sm" style="animation:spin 0.8s linear infinite"></i>';
                }

                // 3. Submit the form AFTER the preview is painted
                requestAnimationFrame(() => {
                    document.getElementById('profileForm').submit();
                });
            };

            reader.readAsDataURL(file);
        }
    </script>
    <style>
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>

</body>
</html>
