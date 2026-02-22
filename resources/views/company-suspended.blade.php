<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended | {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, #1e2744 0%, #2d1b69 40%, #1a3a5c 100%);
            padding: 2rem;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 3rem;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .icon-circle i {
            font-size: 2rem;
            color: #ef4444;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1a1c2e;
            margin-bottom: 0.75rem;
        }
        p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .contact-info {
            background: #f8f9fc;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 2rem;
        }
        .contact-info h3 {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }
        .contact-info a {
            color: #6366f1;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .contact-info a:hover { text-decoration: underline; }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            padding: 0.7rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .btn-back:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
            color: #fff;
        }
        .brand {
            margin-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .brand img { width: 24px; height: 24px; }
        .brand span { font-size: 0.9rem; font-weight: 700; color: #9ca3af; }
        .brand em { font-style: normal; color: #4ade80; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-circle">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h1>Account Suspended</h1>
        <p>Your company account has been deactivated. You are unable to access the system at this time. Please contact support to resolve this issue.</p>

        <div class="contact-info">
            <h3>Need Help?</h3>
            <a href="mailto:support@quantivo.com">support@quantivo.com</a>
        </div>

        <a href="{{ url('/login') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Login
        </a>

        <div class="brand">
            <img src="{{ asset('images/logo_main.png') }}" alt="{{ config('app.name') }}">
            <span>Quant<em>ivo</em></span>
        </div>
    </div>
</body>
</html>
