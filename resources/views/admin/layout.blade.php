<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rural-Link Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --verde:      #2d6a2d;
            --verde-claro:#4a9e4a;
            --terra:      #8b5e2e;
            --creme:      #f5f0e8;
            --cinza:      #e8e2d8;
            --texto:      #1a1a1a;
            --muted:      #6b6b6b;
            --danger:     #c0392b;
            --sidebar-w:  240px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--creme);
            color: var(--texto);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--verde);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
        }

        .sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .sidebar-logo span {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            color: #fff;
            letter-spacing: -.5px;
        }

        .sidebar-logo small {
            display: block;
            color: rgba(255,255,255,.55);
            font-size: .72rem;
            margin-top: 2px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .sidebar nav {
            flex: 1;
            padding: 20px 12px;
        }

        .sidebar nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 500;
            transition: background .15s, color .15s;
            margin-bottom: 4px;
        }

        .sidebar nav a:hover,
        .sidebar nav a.active {
            background: rgba(255,255,255,.15);
            color: #fff;
        }

        .sidebar nav a svg { flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        .sidebar-footer a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 8px;
            color: rgba(255,255,255,.6);
            text-decoration: none;
            font-size: .85rem;
            transition: color .15s;
        }

        .sidebar-footer a:hover { color: #fff; }

        /* ── Main ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--cinza);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--verde);
        }

        .topbar .admin-badge {
            background: var(--verde);
            color: #fff;
            font-size: .72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .content {
            padding: 32px;
            flex: 1;
        }

        /* ── Alerts ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: .88rem;
        }

        .alert-success { background: #d4edda; color: #1a5e1a; border: 1px solid #b8ddb8; }
        .alert-error   { background: #fde8e8; color: #8b0000; border: 1px solid #f5c6c6; }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural-Link" style="height: 40px; object-fit: contain;">
        <small>Painel Admin</small>
    </div>

    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Usuários
        </a>
        <a href="{{ route('admin.postagens') }}" class="{{ request()->routeIs('admin.postagens') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Postagens
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('post.index') }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            Ver site
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="all:unset; cursor:pointer; display:flex; align-items:center; gap:10px; padding:10px 14px; border-radius:8px; color:rgba(255,255,255,.6); font-size:.85rem; width:100%;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Sair
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <h1>@yield('titulo', 'Dashboard')</h1>
        <span class="admin-badge">Admin: {{ auth()->user()->name }}</span>
    </header>

    <div class="content">
        @if(session('sucesso'))
            <div class="alert alert-success">{{ session('sucesso') }}</div>
        @endif
        @if(session('erro'))
            <div class="alert alert-error">{{ session('erro') }}</div>
        @endif

        @yield('conteudo')
    </div>
</div>

@stack('scripts')
</body>
</html>