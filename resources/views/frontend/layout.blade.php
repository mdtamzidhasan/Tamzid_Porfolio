<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $profile->name ?? 'Portfolio' }} — {{ $profile->title ?? 'Developer' }}</title>
    <meta name="description" content="{{ $profile->bio ?? '' }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">

    {{-- AOS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    {{-- Lightbox --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
</head>

<body>

    {{-- Page Loader --}}
    <div id="page-loader">
        <div class="loader-inner">
            <div class="loader-ring"></div>
            <span class="loader-text">Loading...</span>
        </div>
    </div>

    {{-- ========================
         NAVBAR
    ======================== --}}
    <nav id="navbar">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <span class="logo-bracket">&lt;</span>
                {{ Str::upper(substr($profile->name ?? 'Dev', 0, 2)) }}
                <span class="logo-bracket">/&gt;</span>
            </a>

            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="nav-link active">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#experience" class="nav-link">Experience</a></li>
                <li><a href="#certificates" class="nav-link">Certificates</a></li>
                <li><a href="#blog" class="nav-link">Blog</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>

            <div class="nav-actions">
                <button id="themeToggle" class="theme-toggle" title="Toggle theme">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
                <button class="nav-hamburger" id="hamburger">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu Overlay --}}
    <div class="mobile-overlay" id="mobileOverlay"></div>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- ========================
         FOOTER
    ======================== --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="#home" class="nav-logo">
                        <span class="logo-bracket">&lt;</span>
                        {{ Str::upper(substr($profile->name ?? 'Dev', 0, 2)) }}
                        <span class="logo-bracket">/&gt;</span>
                    </a>
                    <p>{{ $profile->taglines[0] ?? 'Building digital experiences' }}</p>
                </div>
                <div class="footer-social">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" title="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($profile->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($profile->facebook)
                    <a href="{{ $profile->facebook }}" target="_blank" title="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $profile->name ?? 'Portfolio' }}. All rights reserved.</p>
                <nav class="footer-nav">
                    <a href="#home">Home</a>
                    <a href="#about">About</a>
                    <a href="#projects">Projects</a>
                    <a href="#contact">Contact</a>
                    <a href="{{ route('blog.index') }}">Blog</a>
                </nav>
            </div>
        </div>
    </footer>

    {{-- Scroll to Top --}}
    <button id="scrollTop" title="Back to top"><i class="fas fa-arrow-up"></i></button>

    {{-- Scripts --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.16/typed.umd.js"></script>
    <script src="{{ asset('js/portfolio.js') }}"></script>
</body>

</html>