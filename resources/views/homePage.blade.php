<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rural Link</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        /* ── CONFIGURAÇÕES GERAIS ── */
        * { 
            font-family: 'Nunito', sans-serif; 
            box-sizing: border-box; 
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        /* ── ESTRUTURA DO CELULAR (Simulação de iPhone) ── */
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
        }

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
            z-index: 50;
        }

        .status-bar {
            padding: 14px 24px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 40;
            flex-shrink: 0;
            background: #15803d;
        }

        .scroll-area {
            flex: 1;
            overflow-y: auto;
            scrollbar-width: none;
            display: flex;
            flex-direction: column;
        }
        .scroll-area::-webkit-scrollbar { display: none; }

        /* ── HEADER E BUSCA ── */
        .header-green {
            background: linear-gradient(160deg, #15803d, #166534);
            padding: 15px 16px 20px;
            flex-shrink: 0;
        }

        .search-box {
            background: white;
            border-radius: 14px;
            padding: 9px 13px;
            display: flex;
            align-items: center;
            gap: 9px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
            margin-bottom: 18px;
        }

        /* CATEGORIAS */
        .cats { 
            display: flex; 
            gap: 12px; 
            justify-content: center; 
            padding-bottom: 4px; 
        }

        /* CARD DE PRODUTO */
        .product-card {
            background: white;
            border-radius: 18px;
            padding: 12px;
            display: flex;
            gap: 12px;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 10px;
            transition: transform 0.2s;
        }

        .product-card:active {
            transform: scale(0.98);
        }

        /* NAVEGAÇÃO */
        .nav-bottom {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-around;
            padding: 8px 0 20px; /* Padding extra para a barra do iPhone */
            z-index: 30;
            border-radius: 0 0 40px 40px;
        }
        
        .nav-item {
            display: flex; flex-direction: column; align-items: center;
            gap: 4px; text-decoration: none; color: #9ca3af;
            font-size: 10px; font-weight: 800;
        }
        .nav-item.active { color: #16a34a; }

        /* BOTÃO FLUTUANTE (POSTAR) */
        .fab {
            position: absolute;
            bottom: 85px;
            right: 20px;
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(34,197,94,0.4);
            text-decoration: none;
            z-index: 100;
        }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="dynamic-island"></div>

        <div class="status-bar">
            <span style="font-size:12px; font-weight:900; color:white;" id="clock">9:41</span>
            <div style="display:flex; align-items:center; gap:5px;">
                <svg width="16" height="11" fill="white"><rect x="0" y="5" width="3" height="7" rx="1"/><rect x="4.5" y="3" width="3" height="9" rx="1"/><rect x="9" y="1" width="3" height="11" rx="1"/><rect x="13.5" y="0" width="3" height="12" rx="1" opacity=".3"/></svg>
                <svg width="22" height="11" fill="white"><rect x=".5" y=".5" width="21" height="11" rx="3.5" stroke="white" stroke-opacity=".35"/><rect x="2" y="2" width="17" height="8" rx="2"/></svg>
            </div>
        </div>

        <div class="scroll-area">
            <div class="header-green">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:15px; margin-top: 10px;">
                    <span style="font-size:22px; font-weight:900; color:white;">Rural <span style="color:#4ade80;">Link</span></span>
                    
                    @auth
                    <a href="{{ route('perfil.show') }}" style="width:36px; height:36px; border-radius:50%; border:2px solid rgba(255,255,255,0.3); overflow:hidden; display:flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.1);">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('storage/'.auth()->user()->profile_image) }}" style="width:100%;height:100%;object-fit:cover;" />
                        @else
                            <span style="color:white; font-weight:900; font-size: 14px;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @endif
                    </a>
                    @else
                    <a href="{{ route('login') }}" style="color: white; font-size: 12px; font-weight: 800; border: 1px solid white; padding: 4px 12px; border-radius: 20px;">Entrar</a>
                    @endauth
                </div>

                <form method="GET" action="{{ route('post.index') }}">
                    <div class="search-box">
                        <svg width="16" height="16" fill="none" stroke="#9ca3af" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar produtos ou produtores" style="flex:1; border:none; outline:none; font-size:13px; color: #374151;" />
                    </div>

                    <div class="cats">
                        @php
                            $categorias = [
                                'organico'    => ['label' => 'Orgânicos',   'img' => 'organicos.jpeg'],
                                'empresa'     => ['label' => 'Empresas',    'img' => 'empresas.jpeg'],
                                'cooperativa' => ['label' => 'Cooperativas', 'img' => 'cooperativas.jpeg'],
                                'autonomo'    => ['label' => 'Autônomos',   'img' => 'autonomos.jpeg'],
                            ];
                        @endphp
                        @foreach($categorias as $val => $cat)
                            <a href="{{ route('post.index', ['selo' => $val]) }}" style="text-decoration:none;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:5px;">
                                    <div style="width:60px; height:60px; border-radius:18px; overflow:hidden; border:{{ request('selo') == $val ? '3px solid #fbbf24' : '2px solid transparent' }}; transition: 0.3s;">
                                        <img src="{{ asset('assets/' . $cat['img']) }}" style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                    <span style="font-size:9px; font-weight:800; color:white;">{{ $cat['label'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </form>
            </div>

            <div style="padding: 16px 12px 100px; flex:1; background:#f3f4f6;">
                @if(!isset($posts) || $posts->isEmpty())
                    <div style="text-align:center; padding:60px 20px;">
                        <div style="margin-bottom:20px; display:flex; justify-content:center;">
                            <img src="{{ asset('assets/imgvazio.png') }}" alt="Vazio" style="width: 180px; opacity: 0.6;">
                        </div>
                        <p style="font-size:15px; font-weight:800; color:#374151; margin-bottom:5px;">Nada por aqui ainda</p>
                        <p style="font-size:12px; color:#9ca3af; font-weight:600;">Tente outro termo ou publique algo!</p>
                    </div>
                @else
                    @foreach($posts as $post)
                        <div class="product-card">
                            @if($post->foto)
                                <img src="{{ asset('storage/' . $post->foto) }}" style="width:80px; height:80px; border-radius:14px; object-fit:cover;" />
                            @else
                                <div style="width:80px; height:80px; border-radius:14px; background:#dcfce7; display:flex; align-items:center; justify-content:center; font-size:32px;">🌿</div>
                            @endif

                            <div style="flex:1;">
                                <div style="display:flex; justify-content:space-between; align-items: flex-start;">
                                    <p style="font-size:14px; font-weight:900; color:#111; line-height: 1.2;">{{ $post->nome }}</p>
                                    <span style="font-size:12px; font-weight:900; color:#16a34a; white-space: nowrap;">R$ {{ number_format($post->preco_kg,2,',','.') }}</span>
                                </div>
                                <p style="font-size:11px; color:#6b7280; font-weight:600; margin: 2px 0 6px;">{{ $post->user->location ?? 'Local não informado' }}</p>
                                <span style="font-size:9px; font-weight:800; padding:3px 8px; border-radius:8px; background:#f0fdf4; color:#16a34a; border: 1px solid #dcfce7;">
                                    {{ ucfirst($post->selo) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        @auth
        <a href="{{ route('post.create') }}" class="fab">
            <svg width="24" height="24" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
        </a>
        @endauth

        <nav class="nav-bottom">
            <a href="{{ route('post.index') }}" class="nav-item {{ !request('selo') ? 'active' : '' }}">
                <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                Início
            </a>
            <a href="{{ route('favoritos.index') }}" class="nav-item">
                <svg width="22" height="22" 
                fill="{{ request()->routeIs('favoritos.index') ? 'currentColor' : 'none' }}" 
                stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                Salvos
            </a>
            <a href="{{ route('perfil.show') }}" class="nav-item">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Perfil
            </a>
        </nav>
    </div>
</div>

<script>
    // Relógio dinâmico
    function tick() {
        const d = new Date();
        document.getElementById('clock').textContent = ${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')};
    }
    tick();
    setInterval(tick, 60000);
</script>

</body>
</html>