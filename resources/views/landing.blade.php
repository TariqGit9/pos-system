<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Smart POS & Inventory Management</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #1a1c2e;
            background: #fff;
            line-height: 1.6;
        }

        /* ── Navbar ── */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 5%;
            background: rgba(30, 39, 68, 0.95);
            backdrop-filter: blur(10px);
        }
        .nav-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .nav-brand img { width: 32px; height: 32px; }
        .nav-brand span {
            margin-left: 10px;
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
        }
        .nav-brand span em {
            font-style: normal;
            color: #4ade80;
        }
        .nav-links { display: flex; align-items: center; gap: 2rem; }
        .nav-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: #fff; }
        .btn-login-nav {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn-login-nav:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        /* ── Hero ── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 8rem 5% 5rem;
            background: linear-gradient(145deg, #1e2744 0%, #2d1b69 40%, #1a3a5c 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 50%, rgba(59, 130, 246, 0.08) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 30%, rgba(99, 60, 200, 0.1) 0%, transparent 50%);
        }
        .hero-content { position: relative; z-index: 1; max-width: 700px; }
        .hero-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(99, 102, 241, 0.25);
        }
        .hero h1 {
            font-size: 3.2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 1.25rem;
        }
        .hero h1 .accent { color: #4ade80; }
        .hero p {
            color: rgba(255,255,255,0.6);
            font-size: 1.15rem;
            max-width: 550px;
            margin: 0 auto 2.5rem;
        }
        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            padding: 0.85rem 2.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.2s;
        }
        .hero-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }
        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 4rem;
            justify-content: center;
        }
        .hero-stat { text-align: center; }
        .hero-stat .number {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
        }
        .hero-stat .label {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.45);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Section Common ── */
        .section {
            padding: 5rem 5%;
        }
        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 3.5rem;
        }
        .section-header .tag {
            display: inline-block;
            color: #6366f1;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.75rem;
        }
        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #1a1c2e;
            margin-bottom: 0.75rem;
        }
        .section-header p {
            color: #6b7280;
            font-size: 1.05rem;
        }

        /* ── Features ── */
        .features { background: #f8f9fc; }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            max-width: 1100px;
            margin: 0 auto;
        }
        .feature-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.75rem;
            transition: all 0.25s;
            border: 1px solid #f0f0f5;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
            border-color: #e0e0ee;
        }
        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }
        .feature-card h3 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1a1c2e;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            color: #6b7280;
            font-size: 0.88rem;
            line-height: 1.6;
        }

        /* icon bg colors */
        .icon-indigo { background: rgba(99,102,241,0.1); color: #6366f1; }
        .icon-green  { background: rgba(74,222,128,0.12); color: #16a34a; }
        .icon-amber  { background: rgba(245,158,11,0.1);  color: #d97706; }
        .icon-sky    { background: rgba(2,132,199,0.1);    color: #0284c7; }
        .icon-rose   { background: rgba(244,63,94,0.1);    color: #e11d48; }
        .icon-violet { background: rgba(139,92,246,0.1);   color: #7c3aed; }

        /* ── How It Works ── */
        .how-it-works { background: #fff; }
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            font-size: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .steps h3 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #1a1c2e;
            margin-bottom: 0.4rem;
        }
        .steps p {
            font-size: 0.88rem;
            color: #6b7280;
        }

        /* ── Pricing ── */
        .pricing { background: #f8f9fc; }
        .pricing-card {
            max-width: 480px;
            margin: 0 auto;
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.06);
            border: 2px solid #e8e8f0;
            position: relative;
            overflow: hidden;
        }
        .pricing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #4ade80);
        }
        .pricing-label {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6366f1;
            margin-bottom: 0.5rem;
        }
        .pricing-card h3 {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1a1c2e;
            margin-bottom: 1.5rem;
        }
        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f5;
        }
        .price-row:last-child { border-bottom: none; }
        .price-row .desc {
            font-size: 0.95rem;
            color: #4b5563;
            font-weight: 500;
        }
        .price-row .amount {
            font-size: 1.3rem;
            font-weight: 800;
            color: #1a1c2e;
        }
        .price-row .amount small {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
        }
        .pricing-note {
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #9ca3af;
        }
        .pricing-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            padding: 0.75rem 2.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .pricing-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.35);
        }
        .pricing-includes {
            margin-top: 2rem;
            text-align: left;
        }
        .pricing-includes h4 {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            margin-bottom: 0.75rem;
        }
        .pricing-includes li {
            list-style: none;
            padding: 0.35rem 0;
            font-size: 0.88rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .pricing-includes li i { color: #4ade80; font-size: 0.9rem; }

        /* ── Footer ── */
        .footer {
            background: #1a1c2e;
            padding: 2.5rem 5%;
            text-align: center;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 0.75rem;
        }
        .footer-brand img { width: 26px; height: 26px; }
        .footer-brand span {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
        }
        .footer-brand span em { font-style: normal; color: #4ade80; }
        .footer p {
            color: rgba(255,255,255,0.35);
            font-size: 0.8rem;
        }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            .nav-links a:not(.btn-login-nav) { display: none; }
            .hero { padding: 7rem 1.5rem 3rem; min-height: auto; }
            .hero h1 { font-size: 2rem; }
            .hero p { font-size: 1rem; }
            .hero-stats { gap: 1.5rem; }
            .hero-stat .number { font-size: 1.2rem; }
            .section { padding: 3.5rem 1.5rem; }
            .section-header h2 { font-size: 1.7rem; }
            .features-grid { grid-template-columns: 1fr; }
            .steps { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="nav">
    <a href="{{ url('/') }}" class="nav-brand">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
        <span>Quant<em>ivo</em></span>
    </a>
    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#pricing">Pricing</a>
        <a href="{{ url('/login') }}" class="btn-login-nav">Login</a>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">All-in-One POS Solution</div>
        <h1>Run Your Business <span class="accent">Smarter</span>, Not Harder</h1>
        <p>Complete point of sale and inventory management system. Track sales, manage purchases, monitor expenses, and generate reports — all from one place.</p>
        <a href="{{ url('/login') }}" class="hero-cta">
            Get Started <i class="bi bi-arrow-right"></i>
        </a>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="number">12+</div>
                <div class="label">Modules</div>
            </div>
            <div class="hero-stat">
                <div class="number">6+</div>
                <div class="label">Reports</div>
            </div>
            <div class="hero-stat">
                <div class="number">100%</div>
                <div class="label">Multi-tenant</div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="section features" id="features">
    <div class="section-header">
        <div class="tag">Features</div>
        <h2>Everything You Need to Run Your Store</h2>
        <p>From quick billing to detailed analytics, Quantivo covers every aspect of your business operations.</p>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon icon-indigo"><i class="bi bi-cart-check-fill"></i></div>
            <h3>Point of Sale (POS)</h3>
            <p>Fast, intuitive POS interface. Scan barcodes, search products, apply discounts, and process payments instantly. Built for speed and ease of use.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-green"><i class="bi bi-box-seam-fill"></i></div>
            <h3>Inventory Management</h3>
            <p>Real-time stock tracking with alerts. Manage product categories, set stock levels, and make adjustments. Never run out of your best sellers.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-amber"><i class="bi bi-receipt-cutoff"></i></div>
            <h3>Sales Management</h3>
            <p>Create and manage sales with full payment tracking. Support partial payments, multiple payment methods, and detailed sale history.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-sky"><i class="bi bi-bag-fill"></i></div>
            <h3>Purchase Management</h3>
            <p>Track all your purchases from suppliers. Record purchase details, manage payments, and keep a complete audit trail of your procurement.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-rose"><i class="bi bi-arrow-left-right"></i></div>
            <h3>Sales & Purchase Returns</h3>
            <p>Handle returns effortlessly. Process sale returns and purchase returns with automatic stock adjustments and payment reconciliation.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-violet"><i class="bi bi-file-earmark-text-fill"></i></div>
            <h3>Quotations</h3>
            <p>Create professional quotations and convert them directly into sales with a single click. Email quotations to customers instantly.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-amber"><i class="bi bi-wallet2"></i></div>
            <h3>Expense Tracking</h3>
            <p>Record and categorize all business expenses. Track where your money goes with expense categories and detailed spending reports.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-sky"><i class="bi bi-people-fill"></i></div>
            <h3>Customers & Suppliers</h3>
            <p>Maintain a complete database of customers and suppliers. Track contact details, transaction history, and outstanding balances.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-indigo"><i class="bi bi-shield-lock-fill"></i></div>
            <h3>User Roles & Permissions</h3>
            <p>Create custom roles with granular permissions. Control who can access what — from cashiers to managers. Keep your data secure.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-green"><i class="bi bi-graph-up-arrow"></i></div>
            <h3>Reports & Analytics</h3>
            <p>Profit/loss reports, sales reports, purchase reports, payment flow analysis, and more. Make data-driven decisions with visual dashboards.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-violet"><i class="bi bi-building"></i></div>
            <h3>Multi-Company Support</h3>
            <p>Run multiple businesses from one system. Each company gets isolated data — separate inventory, customers, sales, and reports.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-rose"><i class="bi bi-upc-scan"></i></div>
            <h3>Barcode Printing</h3>
            <p>Generate and print barcodes for your products. Supports multiple barcode formats for quick scanning at the point of sale.</p>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section how-it-works" id="how-it-works">
    <div class="section-header">
        <div class="tag">How It Works</div>
        <h2>Up and Running in Minutes</h2>
        <p>Getting started with Quantivo is simple. No complex setup required.</p>
    </div>

    <div class="steps">
        <div>
            <div class="step-number">1</div>
            <h3>Create Your Company</h3>
            <p>Set up your business profile with company details, logo, and preferred currency.</p>
        </div>
        <div>
            <div class="step-number">2</div>
            <h3>Add Your Products</h3>
            <p>Import or add your product catalog with prices, categories, and stock levels.</p>
        </div>
        <div>
            <div class="step-number">3</div>
            <h3>Start Selling</h3>
            <p>Use the POS to bill customers, track sales, and manage your entire business from one dashboard.</p>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="section pricing" id="pricing">
    <div class="section-header">
        <div class="tag">Pricing</div>
        <h2>Simple, Transparent Pricing</h2>
        <p>No hidden fees. No monthly subscriptions. Pay once and only pay for what you use.</p>
    </div>

    <div class="pricing-card">
        <div class="pricing-label">All-in-One Plan</div>
        <h3>Everything Included</h3>

        <div class="price-row">
            <span class="desc">One-time Setup Fee</span>
            <span class="amount">Rs 10,000</span>
        </div>
        <div class="price-row">
            <span class="desc">Per Order Charge</span>
            <span class="amount">Rs 1 <small>/ order</small></span>
        </div>

        <a href="{{ url('/login') }}" class="pricing-cta">
            Get Started <i class="bi bi-arrow-right"></i>
        </a>

        <div class="pricing-includes">
            <h4>What's Included</h4>
            <ul>
                <li><i class="bi bi-check-circle-fill"></i> Full POS & Inventory System</li>
                <li><i class="bi bi-check-circle-fill"></i> Unlimited Products & Categories</li>
                <li><i class="bi bi-check-circle-fill"></i> Unlimited Users & Roles</li>
                <li><i class="bi bi-check-circle-fill"></i> Sales, Purchases & Returns</li>
                <li><i class="bi bi-check-circle-fill"></i> Quotations & Expense Tracking</li>
                <li><i class="bi bi-check-circle-fill"></i> All Reports & Analytics</li>
                <li><i class="bi bi-check-circle-fill"></i> Multi-Company Support</li>
                <li><i class="bi bi-check-circle-fill"></i> Barcode Generation & Printing</li>
                <li><i class="bi bi-check-circle-fill"></i> PKR & USD Currency Support</li>
            </ul>
        </div>

        <p class="pricing-note">No monthly fees. No per-user charges. Just a simple setup fee and a tiny per-order charge.</p>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-brand">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
        <span>Quant<em>ivo</em></span>
    </div>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</footer>

</body>
</html>
