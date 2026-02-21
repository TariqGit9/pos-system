<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Login | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    @vite('resources/sass/app.scss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Left branding panel */
        .login-brand {
            flex: 0 0 45%;
            background: linear-gradient(145deg, #1e2744 0%, #2d1b69 40%, #1a3a5c 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            padding-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }
        .login-brand::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 50%, rgba(59, 130, 246, 0.08) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 30%, rgba(99, 60, 200, 0.1) 0%, transparent 50%);
        }
        .login-brand .brand-content {
            position: relative;
            z-index: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .login-brand .brand-logo-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .login-brand .brand-logo-wrapper img {
            width: 50px;
            height: 50px;
        }
        .login-brand .brand-logo-wrapper .brand-name {
            margin-left: 12px;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .login-brand .brand-logo-wrapper .brand-name span {
            color: #4ade80;
        }
        .login-brand p {
            color: rgba(255,255,255,0.5);
            font-size: 0.95rem;
            max-width: 300px;
            line-height: 1.6;
            text-align: center;
            margin: 0;
        }
        .brand-features {
            margin-top: 2.5rem;
            text-align: left;
        }
        .brand-features .feature {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.6);
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .brand-features .feature i {
            color: #4ade80;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Right form panel */
        .login-form-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            padding-bottom: 4rem;
            background: #f8f9fc;
        }
        .login-form-container {
            width: 100%;
            max-width: 400px;
        }
        .login-form-container h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a1c2e;
            margin-bottom: 0.25rem;
        }
        .login-form-container .subtitle {
            color: #9ca3af;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        .form-label-custom {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }
        .input-custom {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fff;
            width: 100%;
        }
        .input-custom:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        .input-custom.is-invalid {
            border-color: #ef4444;
        }
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
        }
        .input-icon-wrapper .input-custom {
            padding-left: 2.5rem;
        }
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            color: #fff;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
            color: #fff;
        }
        .forgot-link {
            color: #6366f1;
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover {
            color: #4f46e5;
            text-decoration: underline;
        }
        .login-footer {
            margin-top: 2.5rem;
            text-align: center;
            color: #9ca3af;
            font-size: 0.8rem;
        }

        /* Responsive: stack on mobile */
        @media (max-width: 768px) {
            .login-wrapper { flex-direction: column; }
            .login-brand {
                flex: none;
                padding: 2rem 1.5rem;
                padding-bottom: 2rem;
                min-height: auto;
            }
            .brand-features { display: none; }
            .login-brand h1 { font-size: 1.5rem; }
            .login-brand .brand-logo-wrapper img { width: 36px; height: 36px; }
            .login-brand .brand-logo-wrapper .brand-name { font-size: 1.4rem; }
            .login-form-panel { padding: 2rem 1.5rem; padding-bottom: 2rem; }
        }
    </style>
</head>

<body>
<div class="login-wrapper">
    <!-- Left branding panel -->
    <div class="login-brand">
        <div class="brand-content">
            <div class="brand-logo-wrapper">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
                <span class="brand-name">Quant<span>ivo</span></span>
            </div>
            <p>Smart inventory and point of sale management for your business</p>

            <div class="brand-features">
                <div class="feature">
                    <i class="bi bi-check-circle-fill"></i>
                    Track inventory in real-time
                </div>
                <div class="feature">
                    <i class="bi bi-check-circle-fill"></i>
                    Manage sales & purchases
                </div>
                <div class="feature">
                    <i class="bi bi-check-circle-fill"></i>
                    Detailed financial reports
                </div>
                <div class="feature">
                    <i class="bi bi-check-circle-fill"></i>
                    Multi-user access control
                </div>
            </div>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="login-form-panel">
        <div class="login-form-container">
            <h2>Welcome back</h2>
            <p class="subtitle">Enter your credentials to access your account</p>

            @if(Session::has('account_deactivated'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('account_deactivated') }}
                </div>
            @endif

            <form id="login" method="post" action="{{ url('/login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label-custom">Email</label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-envelope"></i>
                        <input id="email" type="email"
                               class="input-custom @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               placeholder="you@example.com">
                    </div>
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label-custom mb-0">Password</label>
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot?</a>
                    </div>
                    <div class="input-icon-wrapper mt-1">
                        <i class="bi bi-lock"></i>
                        <input id="password" type="password"
                               class="input-custom @error('password') is-invalid @enderror"
                               placeholder="Enter your password" name="password">
                    </div>
                    @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button id="submit" class="btn btn-login" type="submit">
                        Sign In
                        <div id="spinner" class="spinner-border text-light ml-2" role="status"
                             style="height: 18px;width: 18px;display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </form>

            <div class="login-footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</div>

@vite('resources/js/app.js')
<script>
    let login = document.getElementById('login');
    let submit = document.getElementById('submit');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let spinner = document.getElementById('spinner')

    login.addEventListener('submit', (e) => {
        submit.disabled = true;
        email.readonly = true;
        password.readonly = true;
        spinner.style.display = 'block';
        login.submit();
    });

    setTimeout(() => {
        submit.disabled = false;
        email.readonly = false;
        password.readonly = false;
        spinner.style.display = 'none';
    }, 3000);
</script>
</body>
</html>
