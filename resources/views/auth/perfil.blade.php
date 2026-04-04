{{-- resources/views/auth/perfil.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        /* ── PHONE SHELL ── */
        .phone {
            position: relative;
            width: 375px;
            background: #1a1a1a;
            border-radius: 52px;
            padding: 14px;
            box-shadow:
                0 0 0 2px #3a3a3a,
                0 0 0 4px #111,
                0 40px 80px rgba(0,0,0,0.7),
                inset 0 0 0 1px rgba(255,255,255,0.06);
            animation: phoneIn 0.6s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes phoneIn {
            from { opacity:0; transform:translateY(32px) scale(.96); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }

        /* ── SCREEN ── */
        .screen {
            width: 100%;
            background: #f3f4f6;
            border-radius: 40px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 720px;
            position: relative;
        }

        .dynamic-island {
            position: absolute;
            top: 12px; left: 50%;
            transform: translateX(-50%);
            width: 110px; height: 30px;
            background: #111;
            border-radius: 20px;
            z-index: 20;
        }

        .status-bar {
            padding: 12px 24px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 10;
        }

        /* ── SCROLL AREA ── */
        .scroll-area {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .scroll-area::-webkit-scrollbar { display: none; }

        /* ── HEADER VERDE ── */
        .profile-header {
            background: linear-gradient(160deg, #15803d, #166534);
            padding: 48px 20px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4ade80, #16a34a);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        /* ── CARD BRANCO PRINCIPAL ── */
        .main-card {
            background: white;
            margin: -28px 14px 0;
            border-radius: 24px;
            padding: 16px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            position: relative;
            z-index: 5;
        }

        /* ── PRODUCT CARD ── */
        .product-card {
            background: white;
            border-radius: 18px;
            padding: 12px;
            display: flex;
            gap: 12px;
            align-items: center;
            border: 1.5px solid #f0fdf4;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 10px;
        }

        .product-img {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            object-fit: cover;
            background: #dcfce7;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── BOTÕES ── */
        .btn-green {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            font-weight: 800;
            font-size: 13px;
            padding: 9px 18px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(34,197,94,0.35);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: transform .15s;
        }
        .btn-green:active { transform: scale(.97); }

        .btn-outline-red {
            background: transparent;
            color: #ef4444;
            font-weight: 700;
            font-size: 13px;
            padding: 9px 14px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-add {
            width: 100%;
            background: white;
            border: 1.5px dashed #86efac;
            color: #16a34a;
            font-weight: 800;
            font-size: 13px;
            padding: 13px;
            border-radius: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            transition: background .2s;
        }
        .btn-add:hover { background: #f0fdf4; }

        /* ── NAV BOTTOM ── */
        .nav-bottom {
            background: white;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-around;
            padding: 10px 0 14px;
            flex-shrink: 0;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            text-decoration: none;
            color: #9ca3af;
            font-size: 10px;
            font-weight: 700;
        }
        .nav-item.active { color: #16a34a; }

        .badge-price {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 8px;
        }

        .action-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="dynamic-island"></div>

        {{-- STATUS BAR --}}
        <div class="status-bar" style="background: #15803d;">
            <span style="font-size:13px;font-weight:900;color:white;" id="clock">9:41</span>
            <div style="display:flex;align-items:center;gap:6px;">
                <svg width="17" height="12" viewBox="0 0 17 12" fill="white"><rect x="0" y="5" width="3" height="7" rx="1"/><rect x="4.5" y="3" width="3" height="9" rx="1"/><rect x="9" y="1" width="3" height="11" rx="1"/><rect x="13.5" y="0" width="3" height="12" rx="1" opacity=".3"/></svg>
                <svg width="25" height="12" viewBox="0 0 25 12" fill="white"><rect x=".5" y=".5" width="21" height="11" rx="3.5" stroke="white" stroke-opacity=".35"/><rect x="2" y="2" width="17" height="8" rx="2"/><path d="M23 4v4a2 2 0 000-4z" opacity=".4"/></svg>
            </div>
        </div>

        {{-- Logo --}}
        <div style="position:absolute;top:5px;left:10px;display:flex;align-items:center;gap:6px;z-index:15;">
            <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" style="height:30px;">
        </div>

        <div class="scroll-area">

            {{-- HEADER VERDE COM PERFIL --}}
            <div class="profile-header">
                {{-- Avatar --}}
                @if($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="profile-avatar" style="margin-top:20px;" />
                @else
                    <div class="avatar-placeholder" style="margin-top:20px;">
                        <span style="color:white;font-weight:900;font-size:28px;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                @endif

                <p style="font-size:17px;font-weight:900;color:white;margin:0;">{{ $user->name }}</p>
                <div style="display:flex;align-items:center;gap:4px;">
                    <svg width="13" height="13" fill="#4ade80" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span style="font-size:12px;color:#bbf7d0;font-weight:700;">{{ $user->location ?? 'Localização' }}</span>
                </div>

                {{-- Botões encerrar / editar --}}
                <div style="display:flex;gap:10px;margin-top:4px;">
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-outline-red" style="background:rgba(255,255,255,0.15);color:white;backdrop-filter:blur(4px);">
                            <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Encerrar sessão
                        </button>
                    </form>
                    <a href="{{ route('perfil.edit') }}" class="btn-green">
                        <svg width="14" height="14" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Editar Perfil
                    </a>
                </div>
            </div>

            {{-- CARD SOBRE O PRODUTOR --}}
            <div style="margin: 12px 14px 0; background:white; border-radius:18px; padding:16px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
                <p style="font-size:14px;font-weight:900;color:#111;margin:0 0 6px;">Sobre o Produtor</p>
                <p style="font-size:12px;color:#6b7280;font-weight:600;margin:0;line-height:1.6;">
                    {{ $user->description ?? 'Você ainda não possui uma descrição. Vá em "editar perfil" para adicionar uma!' }}
                </p>
                @if($user->phone)
                    <div style="display:flex;align-items:center;gap:6px;margin-top:10px;">
                        <svg width="13" height="13" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span style="font-size:12px;color:#374151;font-weight:700;">{{ $user->phone }}</span>
                    </div>
                @endif
            </div>

            {{-- CARD MEUS PRODUTOS --}}
            <div style="margin: 12px 14px 28px; background:white; border-radius:18px; padding:16px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
                <p style="font-size:14px;font-weight:900;color:#111;margin:0 0 14px;">Meus Produtos</p>

                @forelse ($user->postagens as $postagem)
                    <div class="product-card">
                        {{-- Imagem do produto --}}
                        <div class="product-img">
                            @if($postagem->foto)
                                <img src="{{ asset('storage/'.$postagem->foto) }}" style="width:60px;height:60px;border-radius:14px;object-fit:cover;" />
                            @else
                                <svg width="24" height="24" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div style="flex:1;min-width:0;">
                            <p style="font-size:13px;font-weight:800;color:#111;margin:0 0 2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $postagem->nome }}</p>
                            <p style="font-size:11px;color:#6b7280;font-weight:600;margin:0 0 4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $postagem->descricao }}</p>

                            @if($postagem->cidade ?? $user->location)
                                <div style="display:flex;align-items:center;gap:3px;margin-bottom:2px;">
                                    <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                                    <span style="font-size:10px;color:#9ca3af;font-weight:600;">{{ $user->location ?? '-' }}</span>
                                </div>
                            @endif

                            <div style="display:flex;align-items:center;gap:3px;margin-bottom:4px;">
                                <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span style="font-size:10px;color:#9ca3af;font-weight:600;">{{ $user->phone ?? '-' }}</span>
                            </div>

                            <span class="badge-price">
                                <svg width="10" height="10" fill="#16a34a" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                R$ {{ number_format($postagem->preco_kg, 2, ',', '.') }} / Kg
                            </span>
                        </div>

                        {{-- Ações --}}
                        <div style="display:flex;flex-direction:column;gap:6px;align-items:center;flex-shrink:0;">
                            <button class="action-icon" title="Favoritar">
                                <svg width="14" height="14" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            </button>
                            
                            <form action="{{ route('post.delete', $postagem->id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-icon" onclick="return confirm('Deletar este produto?')" style="background:#fff5f5;">
                                    <svg width="14" height="14" fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:20px 0;">
                        <div style="width:52px;height:52px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                            <svg width="24" height="24" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <p style="font-size:12px;color:#9ca3af;font-weight:700;margin:0;">Nenhum produto ainda.</p>
                    </div>
                @endforelse

                <a href="{{ route('post.create') }}" class="btn-add" style="margin-top:4px;">
                    <svg width="16" height="16" fill="none" stroke="#16a34a" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Adicionar Produto
                </a>
            </div>

        </div>{{-- /scroll-area --}}

        {{-- NAV BOTTOM --}}
        <nav class="nav-bottom">
            <a href="{{ route('post.index') }}" class="nav-item">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Início
            </a>
            <a href="{{ route('favoritos.index') }}" class="nav-item">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Salvos
            </a>
            <a href="{{ route('perfil.show') }}" class="nav-item active">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Perfil
            </a>
        </nav>

    </div>
</div>

<script>
    function tick() {
        const d = new Date();
        document.getElementById('clock').textContent = `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
    }
    tick();
    setInterval(tick, 10000);
</script>
</body>
</html>