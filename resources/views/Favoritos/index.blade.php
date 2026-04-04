{{-- resources/views/favoritos/index.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salvos</title>
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
        .page-header {
            background: linear-gradient(160deg, #15803d, #166534);
            padding: 48px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: relative;
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
            position: relative;
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
            <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" style="height:120px;">
        </div>

        <div class="scroll-area">

            {{-- HEADER VERDE --}}
            <div class="page-header">
                
            </div>
            {{-- Search bar — separada do header --}}
<div style="background:#f3f4f6;padding:10px 14px;">
    <form method="GET" action="{{ route('favoritos.index') }}">
        <div style="background:white;display:flex;align-items:center;gap:8px;border-radius:14px;padding:10px 14px;border:1px solid #e5e7eb;">
            <svg width="15" height="15" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar nos favoritos (itens salvos: {{ $favoritos->count() }})"
                style="flex:1;background:transparent;border:none;outline:none;font-size:13px;font-weight:600;color:#374151;font-family:'Nunito',sans-serif;"
            />
            @if(request('search') || request('selo'))
                <a href="{{ route('favoritos.index') }}" style="font-size:11px;font-weight:700;color:#9ca3af;text-decoration:none;">✕</a>
            @endif
        </div>
    </form>
</div>

            {{-- CARD ITENS SALVOS --}}
            <div style="margin: 12px 14px 28px; background:white; border-radius:18px; padding:16px; box-shadow:0 2px 10px rgba(0,0,0,0.07);">
                <p style="font-size:14px;font-weight:900;color:#111;margin:0 0 14px;">Meus Salvos</p>

                @forelse ($favoritos as $postagem)
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
<div class="flex items-center gap-0 mb-0.5 flex-wrap">
    <p class="font-black text-[14px] text-gray-900 m-0 whitespace-nowrap">{{ $postagem->nome }}</p>
    <span class="text-gray-300 text-[13px] font-bold mx-1.5">|</span>
    <span class="text-[10px] font-black text-green-700 flex items-center gap-0.5 whitespace-nowrap">
        <svg width="9" height="9" fill="none" stroke="#15803d" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
        </svg>
        {{ ucfirst($postagem->selo ?? 'Sem selo') }}
    </span>
</div>
                            <p style="font-size:11px;color:#6b7280;font-weight:600;margin:0 0 4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($postagem->descricao, 30) }}</p>

                            <div style="display:flex;align-items:center;gap:3px;margin-bottom:2px;">
                                <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                                <span style="font-size:10px;color:#9ca3af;font-weight:600;">{{ $postagem->user->location ?? 'Localização' }}</span>
                            </div>

                            <div style="display:flex;align-items:center;gap:3px;margin-bottom:4px;">
                                <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                @php
                                    $tel = preg_replace('/\D/', '', $postagem->user->phone ?? '');
                                    if (strlen($tel) === 11) {
                                        $tel = substr($tel,0,2).' '.substr($tel,2,1).' '.substr($tel,3,4).'-'.substr($tel,7,4);
                                    } elseif (strlen($tel) === 10) {
                                        $tel = substr($tel,0,2).' '.substr($tel,2,4).'-'.substr($tel,6,4);
                                    } else {
                                        $tel = $postagem->user->phone ?? '-';
                                    }
                                @endphp
                                <span style="font-size:10px;color:#9ca3af;font-weight:600;">{{ $tel }}</span>
                            </div>

                            <span class="badge-price">
                                <svg width="10" height="10" fill="#16a34a" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                R$ {{ number_format($postagem->preco_kg, 2, ',', '.') }} / Kg
                            </span>
                        </div>

                        {{-- Ações (mesma estrutura do perfil) --}}
                        <div style="display:flex;flex-direction:column;gap:6px;align-items:center;flex-shrink:0;">
                            {{-- Botão remover dos salvos --}}
                            <form action="{{ route('favoritos.toggle', $postagem->id) }}" method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="action-icon" title="Remover dos salvos" style="background:#fffbeb;">
                                    <svg width="14" height="14" fill="#f59e0b" stroke="#f59e0b" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:20px 0;">
                        <div style="width:52px;height:52px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                            <svg width="24" height="24" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <p style="font-size:12px;color:#9ca3af;font-weight:700;margin:0;">Nenhum item salvo ainda.</p>
                    </div>
                @endforelse

            </div>

        </div>{{-- /scroll-area --}}

        {{-- NAV BOTTOM --}}
        <nav class="nav-bottom">
            <a href="{{ route('post.index') }}" class="nav-item">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Início
            </a>
            <a href="{{ route('favoritos.index') }}" class="nav-item active">
                <svg width="22" height="22" fill="#16a34a" stroke="#16a34a" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Salvos
            </a>
            <a href="{{ route('perfil.show') }}" class="nav-item">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Perfil
            </a>
        </nav>

    </div>
</div>

<script>
    function tick() {
        const d = new Date();
        document.getElementById('clock').textContent = ${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')};
    }
    tick();
    setInterval(tick, 10000);
</script>
</body>
</html>