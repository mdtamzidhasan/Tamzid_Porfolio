<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        background-image: linear-gradient(rgba(108, 99, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(108, 99, 255, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 80px rgba(0, 0, 0, 0.4);
    }

    .login-logo {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-logo .logo-link {
        font-family: 'Syne', sans-serif;
        font-size: 28px;
        font-weight: 800;
    }

    .login-logo p {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 6px;
    }

    .login-card .form-group {
        margin-bottom: 20px;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon-wrapper i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 14px;
    }

    .input-icon-wrapper input {
        padding-left: 40px !important;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        font-size: 15px;
        margin-top: 8px;
        border-radius: 12px;
    }

    .error-msg {
        background: rgba(255, 80, 80, 0.12);
        border: 1px solid rgba(255, 80, 80, 0.25);
        color: #FF5050;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-logo">
                <a href="{{ route('home') }}" class="logo-link">
                    <span class="logo-bracket">&lt;</span>Admin<span class="logo-bracket">/&gt;</span>
                </a>
                <p>Sign in to manage your portfolio</p>
            </div>

            @if($errors->any())
            <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com"
                            required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                    <input type="checkbox" name="remember" id="remember"
                        style="accent-color:#6C63FF;width:16px;height:16px;">
                    <label for="remember" style="font-size:13px;cursor:pointer;">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary login-btn">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>
        </div>
    </div>
</body>

</html>