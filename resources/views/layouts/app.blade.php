<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM Mahasiswa - Telkom University Style')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --ink: #1e293b;
            --muted: #475569;
            --red: #b91c1c;
            --maroon: #7f1d1d;
            --glass: rgba(255, 255, 255, 0.76);
            --glass-border: rgba(255, 255, 255, 0.78);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            color: var(--ink);
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #f8fafc;
            background-image:
                repeating-linear-gradient(135deg, transparent 0, transparent 47px, rgba(185, 28, 28, 0.035) 48px, transparent 49px),
                repeating-linear-gradient(45deg, transparent 0, transparent 47px, rgba(127, 29, 29, 0.025) 48px, transparent 49px);
            background-attachment: fixed;
        }

        .telu-pattern {
            background-color: #f8fafc;
        }

        a {
            color: inherit;
        }

        .font-helvetica-bold {
            font-weight: 800;
            letter-spacing: 0;
        }

        .telu-glass,
        .ios-glass {
            background: var(--glass);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid var(--glass-border);
            box-shadow: 0 15px 35px rgba(127, 29, 29, 0.09), inset 0 1px 1px rgba(255, 255, 255, 0.9);
        }

        .telu-glass-red {
            color: #fff;
            background: rgba(185, 28, 28, 0.9);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .app-shell {
            width: min(100%, 1152px);
            margin: 0 auto;
        }

        .app-header {
            margin-bottom: 28px;
        }

        .app-topbar {
            height: 8px;
            border-radius: 20px 20px 0 0;
            background: linear-gradient(90deg, #7f1d1d, #b91c1c 52%, #991b1b);
        }

        .app-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 20px;
            border-radius: 0 0 22px 22px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--maroon);
            font-size: 19px;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-logo {
            display: block;
            width: 140px;
            height: auto;
            max-height: 52px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-link,
        .jelly-hover {
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55), box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .nav-link {
            padding: 10px 14px;
            border-radius: 14px;
            color: #334155;
            font-size: 14px;
            text-decoration: none;
        }

        .nav-link:hover {
            color: var(--red);
            background: rgba(185, 28, 28, 0.07);
        }

        .jelly-hover:hover {
            transform: translateY(-4px) scale(1.025);
            box-shadow: 0 16px 26px rgba(127, 29, 29, 0.22);
        }

        .jelly-hover:active {
            transform: scale(0.96);
        }

        .app-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 22px;
        }

        .glass-panel {
            padding: clamp(20px, 4vw, 34px);
            border-radius: 22px;
        }

        .page-title {
            margin: 0 0 8px;
            color: var(--maroon);
            font-size: clamp(25px, 4vw, 34px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: 0;
        }

        .dashboard-title {
            margin: 8px 0;
            color: var(--maroon);
            font-size: clamp(30px, 5vw, 42px);
            line-height: 1.12;
            font-weight: 800;
        }

        .dashboard-subtitle {
            margin: 0;
            color: #475569;
        }

        .dashboard-menu-title {
            margin: 0 0 14px;
            color: var(--maroon);
            font-size: 18px;
            font-weight: 800;
        }

        .page-subtitle {
            margin: 0 0 24px;
            color: var(--muted);
        }

        .action-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 18px 0 22px;
        }

        .button,
        .text-link {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid rgba(127, 29, 29, 0.12);
            border-radius: 13px;
            color: #123149;
            background: rgba(255, 255, 255, 0.62);
            font: inherit;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .button-primary {
            border-color: transparent;
            color: white;
            background: linear-gradient(135deg, #b91c1c, #7f1d1d);
        }

        .button-warning {
            border-color: transparent;
            color: #263649;
            background: #f3c84b;
        }

        .button-danger {
            border-color: transparent;
            color: white;
            background: #991b1b;
        }

        .button:hover,
        .text-link:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        .button-primary:hover {
            background: #7f1d1d;
        }

        .button-warning:hover {
            background: #e6b934;
        }

        .button-danger:hover {
            background: #7f1d1d;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid rgba(127, 29, 29, 0.14);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.44);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th,
        .data-table td {
            padding: 13px 15px;
            border-bottom: 1px solid rgba(127, 29, 29, 0.12);
            vertical-align: middle;
        }

        .data-table th {
            color: #7f1d1d;
            background: rgba(185, 28, 28, 0.07);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .data-table thead tr.telu-table-head th {
            color: #fff;
            background: #b91c1c;
        }

        .sort-button {
            display: inline-flex;
            width: 100%;
            align-items: center;
            gap: 8px;
            padding: 0;
            border: 0;
            color: inherit;
            background: transparent;
            font: inherit;
            text-align: left;
            cursor: pointer;
        }

        .sort-button:hover {
            color: #fee2e2;
        }

        .sort-button:focus-visible {
            outline: 2px solid rgba(255, 255, 255, 0.85);
            outline-offset: 3px;
            border-radius: 3px;
        }

        .data-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .data-table tbody tr:hover {
            background: rgba(185, 28, 28, 0.045);
        }

        .inline-form {
            display: inline;
        }

        .form-stack {
            display: grid;
            max-width: 620px;
            gap: 18px;
        }

        .form-field {
            display: grid;
            gap: 7px;
        }

        .field-label {
            color: #7f1d1d;
            font-size: 14px;
            font-weight: 700;
        }

        .field-input {
            width: 100%;
            min-height: 46px;
            padding: 10px 13px;
            border: 1px solid rgba(127, 29, 29, 0.2);
            border-radius: 12px;
            outline: none;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.72);
            font: inherit;
        }

        .field-input:focus {
            border-color: #b91c1c;
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.14);
        }

        .alert-success,
        .alert-error {
            padding: 14px 17px;
            border-radius: 14px;
            font-weight: 700;
        }

        .alert-success {
            border-left: 4px solid #18a77b;
            color: #135b49;
            background: rgba(222, 250, 239, 0.82);
        }

        .alert-error {
            border-left: 4px solid #b91c1c;
            color: #7f1d1d;
            background: rgba(255, 235, 235, 0.86);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin: 24px 0 30px;
        }

        .stat-item {
            min-width: 0;
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.62);
            border-radius: 18px;
            color: #451a1a;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 12px 26px rgba(127, 29, 29, 0.08);
        }

        .stat-item:nth-child(2) {
            background: rgba(254, 226, 226, 0.86);
        }

        .stat-item:nth-child(3) {
            background: rgba(255, 247, 220, 0.9);
        }

        .stat-label {
            margin: 0 0 10px;
            color: #7f1d1d;
            font-size: 14px;
            font-weight: 700;
        }

        .stat-value {
            margin: 0;
            font-size: 32px;
            line-height: 1;
            font-weight: 800;
        }

        .menu-title {
            margin: 0 0 14px;
            color: var(--maroon);
            font-size: 18px;
            font-weight: 800;
        }

        .empty-state {
            padding: 22px 15px !important;
            color: #62798d;
            text-align: center;
        }

        @media (max-width: 760px) {
            body {
                padding: 14px;
            }

            .app-nav {
                align-items: flex-start;
                flex-direction: column;
                padding: 14px;
            }

            .nav-links {
                justify-content: flex-start;
                width: 100%;
            }

            .nav-link {
                padding: 9px 11px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }

            .data-table {
                min-width: 620px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }
    </style>

</head>
<body class="telu-pattern">
    <div class="app-shell">
        <header class="app-header">
            <div class="app-topbar" aria-hidden="true"></div>
            <nav class="app-nav ios-glass" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" class="brand jelly-hover" aria-label="Dashboard SIM Telkom University">
                    <img src="{{ asset('telkom-university-logo.webp') }}" alt="Telkom University" class="brand-logo">
                </a>
                <div class="nav-links">
                    <a href="{{ route('home') }}" class="nav-link jelly-hover">Dashboard</a>
                    <a href="{{ route('prodi.index') }}" class="nav-link jelly-hover">Prodi</a>
                    <a href="{{ route('mata-kuliah.index') }}" class="nav-link jelly-hover">Mata Kuliah</a>
                    <a href="{{ route('mahasiswa.index') }}" class="nav-link jelly-hover">Mahasiswa</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
    @csrf
    <button 
        type="submit" 
        class="bg-red-50/80 hover:bg-red-700 text-red-700 hover:text-white border border-red-200 font-extrabold px-4 py-2 rounded-xl text-xs transition-all flex items-center gap-2 shadow-sm jelly-hover"
    >
        <span>🚪</span>
        <span>Keluar (Logout)</span>
    </button>
</form>
                </div>
            </nav>
        </header>

        <main class="app-main">
            @if(session('success'))
                <div class="alert-success" role="status">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>