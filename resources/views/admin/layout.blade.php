<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel — @yield('page-title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">
        {{-- ── SIDEBAR ── --}}
        <aside class="admin-sidebar" id="sidebar">
            <div class="sidebar-logo">
                <a href="{{ route('admin.dashboard') }}" class="logo-link">
                    <span class="logo-bracket">&lt;</span>Admin<span class="logo-bracket">/&gt;</span>
                </a>
                <button class="sidebar-close" id="sidebarClose"><i class="fas fa-times"></i></button>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-label">Main</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.profile.edit') }}"
                    class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle"></i> <span>Profile</span>
                </a>

                <div class="nav-section-label">Portfolio</div>
                <a href="{{ route('admin.projects.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="fas fa-code"></i> <span>Projects</span>
                </a>
                <a href="{{ route('admin.skills.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i> <span>Skills</span>
                </a>
                <a href="{{ route('admin.certificates.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                    <i class="fas fa-certificate"></i> <span>Certificates</span>
                </a>
                <a href="{{ route('admin.experience.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i> <span>Experience</span>
                </a>
                <a href="{{ route('admin.education.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i> <span>Education</span>
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i> <span>Testimonials</span>
                </a>

                <div class="nav-section-label">Content</div>
                <a href="{{ route('admin.blogs.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="fas fa-pen-nib"></i> <span>Blog Posts</span>
                </a>
                <a href="{{ route('admin.messages.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                    @php $unread = \App\Models\Contact::unread()->count(); @endphp
                    @if($unread > 0)
                    <span class="badge-count">{{ $unread }}</span>
                    @endif
                </a>

                <div class="nav-section-label">System</div>
                <a href="{{ route('admin.settings.edit') }}"
                    class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h"></i> <span>Settings</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                    <i class="fas fa-external-link-alt"></i> <span>View Site</span>
                </a>
            </nav>

            <div class="sidebar-user">
                <img src="{{ Auth::guard('admin')->user()->avatar_url }}" alt="Admin">
                <div class="user-info">
                    <span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
                    <span class="user-role">Administrator</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </aside>

        {{-- ── MAIN CONTENT ── --}}
        <div class="admin-main">
            {{-- Topbar --}}
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="topbar-right">
                    <button id="adminThemeToggle" class="theme-btn" title="Toggle theme">
                        <i class="fas fa-moon" id="adminThemeIcon"></i>
                    </button>
                </div>
            </header>

            {{-- Breadcrumb --}}
            @hasSection('breadcrumb')
            <div class="breadcrumb-bar">
                @yield('breadcrumb')
            </div>
            @endif

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="flash-message success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button class="flash-close"><i class="fas fa-times"></i></button>
            </div>
            @endif
            @if(session('error'))
            <div class="flash-message error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
                <button class="flash-close"><i class="fas fa-times"></i></button>
            </div>
            @endif

            {{-- Page Content --}}
            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
    // Admin sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('sidebarClose');

    toggleBtn?.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    });
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }

    // Flash close
    document.querySelectorAll('.flash-close').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.flash-message').remove());
    });

    // Admin theme toggle
    const adminThemeBtn = document.getElementById('adminThemeToggle');
    const adminThemeIcon = document.getElementById('adminThemeIcon');
    const htmlEl = document.documentElement;
    const theme = localStorage.getItem('admin-theme') || 'dark';
    htmlEl.setAttribute('data-theme', theme);
    adminThemeIcon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    adminThemeBtn?.addEventListener('click', () => {
        const t = htmlEl.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        htmlEl.setAttribute('data-theme', t);
        localStorage.setItem('admin-theme', t);
        adminThemeIcon.className = t === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    });
    </script>

    @stack('scripts')
</body>

</html>