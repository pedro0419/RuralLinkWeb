<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rural Link</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <style>

      /* Fundo desfocado */
.overlay-blur {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(6px);
    z-index: 90;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}
.overlay-blur.ativo {
    opacity: 1;
    pointer-events: auto;
}

/* Estado do card quando estiver no meio da tela */
.product-card {
    transition: all 0.3s ease; /* Adiciona uma transição suave no card original */
    /* ... seus estilos existentes do product-card ficam intactos ... */
}

.product-card.focado {
    position: absolute;
    top: 50%;
    left: 14px;
    right: 14px;
    transform: translateY(-50%);
    z-index: 100;
    margin: 0;
    box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    max-height: 80%; /* Evita que o card saia da tela se o texto for muito grande */
    overflow-y: auto;
}
        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; }
        body {
            min-height: 100vh; margin: 0; background: #0f172a;
            display: flex; align-items: center; justify-content: center; padding: 32px 16px;
        }
        .phone {
            position: relative; width: 375px; background: #1a1a1a;
            border-radius: 52px; padding: 14px;
            box-shadow: 0 0 0 2px #3a3a3a, 0 0 0 4px #111, 0 40px 80px rgba(0,0,0,0.7), inset 0 0 0 1px rgba(255,255,255,0.06);
        }
        .screen {
            width: 100%; background: #f3f4f6; border-radius: 40px;
            overflow: hidden; display: flex; flex-direction: column; height: 720px; position: relative;
        }
        .dynamic-island {
            position: absolute; top: 12px; left: 50%; transform: translateX(-50%);
            width: 110px; height: 30px; background: #111; border-radius: 20px; z-index: 50;
        }
        .status-bar {
            padding: 14px 24px 6px; display: flex; justify-content: space-between;
            align-items: center; position: relative; z-index: 40; flex-shrink: 0; background: #15803d;
        }
        .scroll-area { flex: 1; overflow-y: auto; scrollbar-width: none; display: flex; flex-direction: column; }
        .scroll-area::-webkit-scrollbar { display: none; }

        .header-green { background: linear-gradient(160deg, #15803d, #166534); padding: 15px 16px 20px; flex-shrink: 0; }
        .search-box {
            background: white; border-radius: 14px; padding: 9px 13px;
            display: flex; align-items: center; gap: 9px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2); margin-bottom: 18px;
        }
        .cats { display: flex; gap: 12px; justify-content: center; padding-bottom: 4px; }

        .product-card {
            background: white; border-radius: 18px; padding: 12px;
            border: 1.5px solid #f0fdf4; box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 10px;
        }
        .product-card-top {
            display: flex; gap: 12px; align-items: center;
        }
        .product-img { width: 85px; height: 85px; border-radius: 14px; object-fit: cover; flex-shrink: 0; }
        .product-img-placeholder {
            width: 85px; height: 85px; border-radius: 14px; background: #dcfce7;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .badge-price {
            display: inline-flex; align-items: center; gap: 4px;
            background: #dcfce7; color: #16a34a; font-size: 11px; font-weight: 800;
            padding: 3px 8px; border-radius: 8px; margin-top: 4px;
        }
        .action-icon {
            width: 34px; height: 34px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; border: none; transition: transform .15s; flex-shrink: 0;
        }
        .action-icon.fav { background: #fffbeb; }
        .action-icon.no-fav { background: #f3f4f6; }
        .action-icon:active { transform: scale(.85); }

        /* ── Ver mais ── */
        .ver-mais-btn {
            display: flex; align-items: center; gap: 3px;
            background: none; border: none; cursor: pointer;
            color: #16a34a; font-size: 11px; font-weight: 800;
            padding: 6px 0 0; font-family: 'Nunito', sans-serif;
        }
        .ver-mais-btn svg { transition: transform .25s; }
        .ver-mais-btn.aberto svg { transform: rotate(180deg); }

        .expandido {
            max-height: 0; overflow: hidden;
            transition: max-height .35s ease, opacity .2s ease;
            opacity: 0;
        }
        .expandido.aberto {
            max-height: 500px;
            opacity: 1;
        }

        .produtor-foto {
            width: 46px; height: 46px; border-radius: 50%;
            object-fit: cover; border: 2px solid #bbf7d0; flex-shrink: 0;
        }
        .produtor-foto-placeholder {
            width: 46px; height: 46px; border-radius: 50%;
            background: #dcfce7; border: 2px solid #bbf7d0;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 15px; font-weight: 900; color: #16a34a;
        }
        /* ── fim Ver mais ── */

        .nav-bottom {
            background: white; border-top: 1px solid #f0f0f0;
            display: flex; justify-content: space-around; padding: 10px 0 14px; flex-shrink: 0;
        }
        .nav-item { display: flex; flex-direction: column; align-items: center; gap: 3px; text-decoration: none; color: #9ca3af; font-size: 10px; font-weight: 700; }
        .nav-item.active { color: #16a34a; }

        .fab {
            position: absolute; bottom: 75px; right: 20px; width: 52px; height: 52px;
            background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 6px 20px rgba(34,197,94,0.4); text-decoration: none; z-index: 100;
        }
    </style>
</head>
<body>

<div class="phone">
  <div class="screen">
    <div id="overlay-blur" class="overlay-blur" onclick="fecharTodos()"></div>
    <div class="dynamic-island"></div>

    <div class="status-bar">
      <span style="font-size:12px;font-weight:900;color:white;" id="clock">9:41</span>
      <div style="display:flex;align-items:center;gap:5px;">
        <svg width="16" height="11" fill="white"><rect x="0" y="5" width="3" height="7" rx="1"/><rect x="4.5" y="3" width="3" height="9" rx="1"/><rect x="9" y="1" width="3" height="11" rx="1"/><rect x="13.5" y="0" width="3" height="12" rx="1" opacity=".3"/></svg>
        <svg width="22" height="11" fill="white"><rect x=".5" y=".5" width="21" height="11" rx="3.5" stroke="white" stroke-opacity=".35"/><rect x="2" y="2" width="17" height="8" rx="2"/></svg>
      </div>
    </div>

    <div class="scroll-area">
      <div class="header-green">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:15px;margin-top:10px;">
          <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" style="height:44px;object-fit:contain;">

          @auth
          <a href="{{ route('perfil.show') }}" style="width:40px;height:40px;border-radius:50%;border:2px solid rgba(255,255,255,0.3);overflow:hidden;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.1);">
            @if(auth()->user()->profile_image)
              <img src="{{ Storage::disk('s3')->url(auth()->user()->profile_image) }}" style="width:100%;height:100%;object-fit:cover;" />
            @else
              <span style="color:white;font-weight:900;font-size:15px;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            @endif
          </a>
          @else
          <a href="{{ route('login') }}" style="color:white;font-size:12px;font-weight:800;border:1px solid white;padding:4px 12px;border-radius:20px;">Entrar</a>
          @endauth
        </div>

        <form method="GET" action="{{ route('post.index') }}">
          <div class="search-box">
            <svg width="16" height="16" fill="none" stroke="#9ca3af" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar produtos ou produtores" style="flex:1;border:none;outline:none;font-size:13px;color:#374151;" />
          </div>

          <div class="cats">
            @php
              $categorias = [
                'organico'    => ['label'=>'Orgânicos',    'img'=>'organicos.jpeg'],
                'empresa'     => ['label'=>'Empresas',     'img'=>'empresas.jpeg'],
                'cooperativa' => ['label'=>'Cooperativas', 'img'=>'cooperativas.jpeg'],
                'autonomo'    => ['label'=>'Autônomos',    'img'=>'autonomos.jpeg'],
              ];
            @endphp
            @foreach($categorias as $val => $cat)
              <a href="{{ route('post.index', ['selo' => $val]) }}" style="text-decoration:none;">
                <div style="display:flex;flex-direction:column;align-items:center;gap:5px;">
                  <div style="width:60px;height:60px;border-radius:18px;overflow:hidden;border:{{ request('selo')==$val ? '3px solid #fbbf24' : '2px solid transparent' }};transition:0.3s;">
                    <img src="{{ asset('assets/'.$cat['img']) }}" style="width:100%;height:100%;object-fit:cover;">
                  </div>
                  <span style="font-size:9px;font-weight:800;color:white;">{{ $cat['label'] }}</span>
                </div>
              </a>
            @endforeach
          </div>
        </form>
      </div>

      <div style="flex:1; background:#f3f4f6; padding:16px 14px;">
        @if($posts->isEmpty())
          <div style="text-align:center; padding-top:40px;">
            <p style="font-weight:800; color:#9ca3af;">Nenhum produto encontrado.</p>
          </div>
        @else
          @php $favoritadosIds = auth()->user() ? auth()->user()->favoritos->pluck('id')->toArray() : []; @endphp

          @foreach($posts as $post)
            @php $isFav = in_array($post->id, $favoritadosIds); @endphp
            <div class="product-card">

              {{-- Linha principal --}}
              <div class="product-card-top">
                @if($post->foto)
                  <img src="{{ Storage::disk('s3')->url($post->foto) }}" class="product-img" class="product-img" />
                @else
                  <div class="product-img-placeholder">
                    <svg width="28" height="28" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  </div>
                @endif

                <div style="flex:1; min-width:0;">
                  <div style="display:flex; align-items:center; gap:5px; margin-bottom:2px;">
                    <p style="font-weight:900; font-size:14px; color:#111; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $post->nome }}</p>
                    <span style="font-size:10px; font-weight:800; color:#15803d; background:#dcfce7; padding:1px 6px; border-radius:6px;">{{ ucfirst($post->selo) }}</span>
                  </div>

                  <div style="display:flex; align-items:center; gap:4px; margin-bottom:3px;">
                    <svg width="12" height="12" fill="none" stroke="#4b5563" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span style="font-size:11px; color:#374151; font-weight:800;">{{ $post->user->name }}</span>
                  </div>

                  <div style="display:flex; align-items:center; gap:4px; margin-bottom:2px;">
                    <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                    <span style="font-size:10px; color:#9ca3af; font-weight:600;">{{ $post->user->location ?? 'Local não informado' }}</span>
                  </div>

                  <div style="display:flex; align-items:center; gap:4px; margin-bottom:4px;">
                    <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span style="font-size:10px; color:#9ca3af; font-weight:600;">{{ $post->user->phone ?? 'Sem contato' }}</span>
                  </div>

                  <span class="badge-price">
                    R$ {{ number_format($post->preco_kg, 2, ',', '.') }} / Kg
                  </span>
                </div>

                @auth
                <div style="display:flex; flex-direction:column; align-items:center; gap:6px;">
                  <form action="{{ route('favoritos.toggle', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="action-icon {{ $isFav ? 'fav' : 'no-fav' }}">
                      <svg width="18" height="18" fill="{{ $isFav ? '#f97316' : 'none' }}" stroke="{{ $isFav ? '#f97316' : '#d1d5db' }}" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                      </svg>
                    </button>
                  </form>
                </div>
                @endauth
              </div>

              {{-- Botão Ver mais --}}
              <button class="ver-mais-btn" onclick="toggleVerMais(this)">
                Ver mais
              </button>

              {{-- Seção expandida --}}
              <div class="expandido">
                <div style="border-top: 1.5px solid #f0fdf4; margin-top: 8px; padding-top: 12px;">

                  {{-- Foto e nome do produtor --}}
                  <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                    @if($post->user->profile_image)
                      <img src="{{ Storage::disk('s3')->url($post->user->profile_image) }}" class="produtor-foto" />
                    @else
                      <div class="produtor-foto-placeholder">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                      </div>
                    @endif
                    <div>
                      <p style="font-size:12px; font-weight:900; color:#111; margin:0;">{{ $post->user->name }}</p>
                      <p style="font-size:10px; color:#6b7280; font-weight:600; margin:0;">Produtor</p>
                    </div>
                  </div>

                  {{-- Descrição --}}
                  @if($post->descricao)
                  <div style="margin-bottom:10px;">
                    <p style="font-size:11px; font-weight:800; color:#374151; margin:0 0 3px;">Descrição do produto</p>
                    <p style="font-size:11px; color:#6b7280; font-weight:600; margin:0; line-height:1.5;">{{ $post->descricao }}</p>
                  </div>
                  @endif

                  {{-- Estoque --}}
                  <div style="display:flex; align-items:center; gap:6px;">
                    <div style="display:flex; align-items:center; gap:4px; background:#f0fdf4; padding:5px 10px; border-radius:10px;">
                      <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                      <span style="font-size:11px; font-weight:800; color:#15803d;">
                        Estoque: {{ $post->quantidade ?? 0 }} Kg
                      </span>
                    </div>
                  </div>

                </div>
              </div>
              {{-- fim seção expandida --}}

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
      <a href="{{ route('post.index') }}" class="nav-item active">
        <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        Início
      </a>
      <a href="{{ route('favoritos.index') }}" class="nav-item">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        Salvos
      </a>
      <a href="{{ route('perfil.show') }}" class="nav-item">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Perfil
      </a>
      @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="nav-item">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.  77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Admin
        </a>
      @endif
    </nav>
  </div>
</div>

<script>
  function tick() {
    const d = new Date();
    document.getElementById('clock').textContent = `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
  }
  tick(); setInterval(tick, 60000);

function toggleVerMais(btn) {
    const card = btn.closest('.product-card');
    const expandido = card.querySelector('.expandido');
    const overlay = document.getElementById('overlay-blur');

    // Verifica se o card atual já está aberto
    const estaAberto = card.classList.contains('focado');

    if (!estaAberto) {
        // Se não estava aberto, primeiro fechamos qualquer outro que esteja
        fecharTodos();

        // Agora abre o card atual
        card.classList.add('focado');
        expandido.classList.add('aberto');
        btn.classList.add('aberto');
        overlay.classList.add('ativo');
        
        // MUDA O TEXTO: Como não tem mais SVG, alteramos o conteúdo direto do botão
        btn.textContent = 'Ver menos';
    } else {
        // Se já estava aberto e o usuário clicou de novo, a gente fecha
        fecharTodos();
    }
}

function fecharTodos() {
    // Remove o foco de todos os cards
    document.querySelectorAll('.product-card.focado').forEach(c => {
        c.classList.remove('focado');
        c.querySelector('.expandido').classList.remove('aberto');
        
        // Reseta o texto do botão para "Ver mais"
        const btn = c.querySelector('.ver-mais-btn');
        btn.classList.remove('aberto');
        btn.textContent = 'Ver mais';
    });
    
    // Esconde o fundo desfocado
    const overlay = document.getElementById('overlay-blur');
    if (overlay) overlay.classList.remove('ativo');
}
</script>
</body>
</html>