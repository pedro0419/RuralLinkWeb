<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salvos</title>
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

        /* Estado do card focado */
        .product-card.focado {
            position: absolute;
            top: 50%;
            left: 14px;
            right: 14px;
            transform: translateY(-50%);
            z-index: 100;
            margin: 0;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            max-height: 80%;
            overflow-y: auto;
        }

        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; }
        body { min-height:100vh; margin:0; background:#0f172a; display:flex; align-items:center; justify-content:center; padding:32px 16px; }
        .phone { position:relative; width:375px; background:#1a1a1a; border-radius:52px; padding:14px; box-shadow:0 0 0 2px #3a3a3a,0 0 0 4px #111,0 40px 80px rgba(0,0,0,0.7),inset 0 0 0 1px rgba(255,255,255,0.06); animation:phoneIn 0.6s cubic-bezier(.22,1,.36,1) both; }
        @keyframes phoneIn { from{opacity:0;transform:translateY(32px) scale(.96)} to{opacity:1;transform:translateY(0) scale(1)} }
        .screen { width:100%; background:#f3f4f6; border-radius:40px; overflow:hidden; display:flex; flex-direction:column; height:720px; position:relative; }
        .dynamic-island {
            position: absolute;
            top: 12px; left: 50%;
            transform: translateX(-50%);
            width: 110px; height: 30px;
            background: #111;
            border-radius: 20px;
            z-index: 100;
        } 
        .status-bar { padding:14px 24px 6px; display:flex; justify-content:space-between; align-items:center; position:relative; z-index:40; flex-shrink:0; background:#15803d; }
        .scroll-area { flex:1; overflow-y:auto; scrollbar-width:none; }
        .scroll-area::-webkit-scrollbar { display:none; }
        .page-header { background:linear-gradient(160deg,#15803d,#166534); padding:15px 20px 20px; display:flex; align-items:center; justify-content:space-between; }
        
        .product-card { background:white; border-radius:18px; padding:12px; border:1.5px solid #f0fdf4; box-shadow:0 2px 8px rgba(0,0,0,0.06); margin-bottom:10px; transition: all 0.3s ease; }
        .product-card-top { display: flex; gap: 12px; align-items: center; }
        .product-img { width:80px; height:80px; border-radius:14px; object-fit:cover; flex-shrink:0; }
        .product-img-placeholder { width:80px; height:80px; border-radius:14px; background:#dcfce7; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        
        .badge-price { display:inline-flex; align-items:center; gap:4px; background:#dcfce7; color:#16a34a; font-size:11px; font-weight:800; padding:3px 8px; border-radius:8px; margin-top:4px; }
        .action-icon { width:32px; height:32px; border-radius:10px; display:flex; align-items:center; justify-content:center; background:#fffbeb; cursor:pointer; border:none; transition:transform .15s; }
        .action-icon:active { transform:scale(.85); }

        /* Lógica Ver Mais */
        .ver-mais-btn {
            display: flex; align-items: center; gap: 3px;
            background: none; border: none; cursor: pointer;
            color: #16a34a; font-size: 11px; font-weight: 800;
            padding: 6px 0 0; font-family: 'Nunito', sans-serif;
        }
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
        
        .nav-bottom { background:white; border-top:1px solid #f0f0f0; display:flex; justify-content:space-around; padding:10px 0 14px; flex-shrink:0; }
        .nav-item { display:flex; flex-direction:column; align-items:center; gap:3px; text-decoration:none; color:#9ca3af; font-size:10px; font-weight:700; }
        .nav-item.active { color:#16a34a; }
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

    <div class="page-header">
      <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" style="height:44px;object-fit:contain;">
    </div>

    <div class="scroll-area">
      <div style="background:#f3f4f6;padding:10px 14px;">
        <form method="GET" action="{{ route('favoritos.index') }}">
          <div style="background:white;display:flex;align-items:center;gap:8px;border-radius:14px;padding:10px 14px;border:1px solid #e5e7eb;">
            <svg width="15" height="15" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="search" value="{{ request('search') }}"
              placeholder="Buscar nos favoritos ({{ $favoritos->count() }} salvos)"
              style="flex:1;background:transparent;border:none;outline:none;font-size:13px;font-weight:600;color:#374151;font-family:'Nunito',sans-serif;" />
            @if(request('search'))
              <a href="{{ route('favoritos.index') }}" style="font-size:11px;font-weight:700;color:#9ca3af;text-decoration:none;">✕</a>
            @endif
          </div>
        </form>
      </div>

      <div style="margin:12px 14px 28px;background:white;border-radius:18px;padding:16px;box-shadow:0 2px 10px rgba(0,0,0,0.07);">
        <p style="font-size:14px;font-weight:900;color:#111;margin:0 0 14px;">Meus Salvos</p>

        @forelse ($favoritos as $postagem)
          <div class="product-card">
            <div class="product-card-top">
                @if($postagem->foto)
                  <img src="{{ Storage::disk('s3')->url($postagem->foto) }}" class="product-img" />
                @else
                  <div class="product-img-placeholder">
                    <svg width="28" height="28" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                  </div>
                @endif

                <div style="flex:1;min-width:0;">
                  <div style="display:flex;align-items:center;gap:5px;margin-bottom:2px;">
                    <p style="font-weight:900;font-size:14px;color:#111;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $postagem->nome }}</p>
                    <span style="font-size:10px;font-weight:800;color:#15803d;background:#dcfce7;padding:1px 6px;border-radius:6px;">{{ ucfirst($postagem->selo ?? 'Selo') }}</span>
                  </div>

                  <div style="display:flex; align-items:center; gap:4px; margin-bottom:3px;">
                    <svg width="12" height="12" fill="none" stroke="#4b5563" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span style="font-size:11px; color:#374151; font-weight:800;">{{ $postagem->user->name }}</span>
                  </div>

                  <div style="display:flex;align-items:center;gap:4px;margin-bottom:2px;">
                    <svg width="11" height="11" fill="none" stroke="#9ca3af" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                    <span style="font-size:10px;color:#9ca3af;font-weight:600;">{{ $postagem->user->location ?? 'Localização' }}</span>
                  </div>

                  <span class="badge-price">
                    R$ {{ number_format($postagem->preco_kg, 2, ',', '.') }} / Kg
                  </span>
                </div>

                <form action="{{ route('favoritos.toggle', $postagem->id) }}" method="POST" style="margin:0;">
                  @csrf
                  <button type="submit" class="action-icon" title="Remover dos salvos">
                    <svg width="17" height="17" fill="#f97316" stroke="#f97316" stroke-width="1.5" viewBox="0 0 24 24">
                      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                  </button>
                </form>
            </div>

            <button class="ver-mais-btn" onclick="toggleVerMais(this)">
                Ver mais
            </button>

            <div class="expandido">
                <div style="border-top: 1.5px solid #f0fdf4; margin-top: 8px; padding-top: 12px;">
                  <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                    @if($postagem->user->profile_image)
                      <img src="{{ Storage::disk('s3')->url($postagem->user->profile_image) }}" class="produtor-foto" />
                    @else
                      <div class="produtor-foto-placeholder">
                        {{ strtoupper(substr($postagem->user->name, 0, 1)) }}
                      </div>
                    @endif
                    <div>
                      <p style="font-size:12px; font-weight:900; color:#111; margin:0;">{{ $postagem->user->name }}</p>
                      <p style="font-size:10px; color:#6b7280; font-weight:600; margin:0;">Produtor</p>
                    </div>
                  </div>

                  @if($postagem->descricao)
                  <div style="margin-bottom:10px;">
                    <p style="font-size:11px; font-weight:800; color:#374151; margin:0 0 3px;">Descrição do produto</p>
                    <p style="font-size:11px; color:#6b7280; font-weight:600; margin:0; line-height:1.5;">{{ $postagem->descricao }}</p>
                  </div>
                  @endif

                  <div style="display:flex; align-items:center; gap:6px;">
                    <div style="display:flex; align-items:center; gap:4px; background:#f0fdf4; padding:5px 10px; border-radius:10px;">
                      <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                      <span style="font-size:11px; font-weight:800; color:#15803d;">
                        Estoque: {{ $postagem->quantidade ?? 0 }} Kg
                      </span>
                    </div>
                  </div>
                </div>
            </div>

          </div>
        @empty
          <div style="text-align:center;padding:20px 0;">
            <div style="width:52px;height:52px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
              <svg width="24" height="24" fill="none" stroke="#86efac" stroke-width="2" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <p style="font-size:12px;color:#9ca3af;font-weight:700;margin:0;">Nenhum item salvo ainda.</p>
          </div>
        @endforelse
      </div>
    </div>

    <nav class="nav-bottom">
      <a href="{{ route('post.index') }}" class="nav-item">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        Início
      </a>
      <a href="{{ route('favoritos.index') }}" class="nav-item active">
        <svg width="22" height="22" fill="#16a34a" stroke="#16a34a" stroke-width="1.5" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
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
  function tick() {
    const d = new Date();
    document.getElementById('clock').textContent = `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
  }
  tick(); setInterval(tick, 10000);

  function toggleVerMais(btn) {
    const card = btn.closest('.product-card');
    const expandido = card.querySelector('.expandido');
    const overlay = document.getElementById('overlay-blur');

    const estaAberto = card.classList.contains('focado');

    if (!estaAberto) {
        fecharTodos();
        card.classList.add('focado');
        expandido.classList.add('aberto');
        btn.classList.add('aberto');
        overlay.classList.add('ativo');
        btn.textContent = 'Ver menos';
    } else {
        fecharTodos();
    }
  }

  function fecharTodos() {
    document.querySelectorAll('.product-card.focado').forEach(c => {
        c.classList.remove('focado');
        c.querySelector('.expandido').classList.remove('aberto');
        const btn = c.querySelector('.ver-mais-btn');
        btn.classList.remove('aberto');
        btn.textContent = 'Ver mais';
    });
    const overlay = document.getElementById('overlay-blur');
    if (overlay) overlay.classList.remove('ativo');
  }
</script>
</body>
</html>