<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Novo Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            background: #0f172a; /* Fundo externo escuro */
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
            width:100%;
            background:#f3f4f6;
            border-radius:40px;
            overflow:hidden;
            display:flex;
            flex-direction:column;
            height: 720px;
            position: relative;
        }

        .dynamic-island {
            position:absolute;
            top:12px; left:50%;
            transform:translateX(-50%);
            width:110px; height:30px;
            background:#111;
            border-radius:20px;
            z-index:20;
        }

        .status-bar {
            padding:12px 24px 6px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            position:relative;
            z-index:10;
        }

        /* ── SCROLL AREA (Com a imagem de fundo original) ── */
        .scroll-area {
            flex:1;
            overflow-y:auto;
            scrollbar-width:none;
            background: linear-gradient(rgba(20, 45, 20, 0.5), rgba(10, 25, 10, 0.6)), 
                        url("{{ asset('assets/WhatsApp Image 2026-04-03 at 11.51.18.jpeg') }}");
            background-size: cover;
            background-position: center;
        }
        .scroll-area::-webkit-scrollbar { display:none; }

        /* ── INPUTS ORIGINAIS ── */
        .input-field {
            width:100%;
            background:#f8fafb;
            border:1.5px solid #e5e7eb;
            border-radius:16px;
            padding:13px 14px 13px 42px;
            font-size:14px;
            color:#374151;
            font-weight:600;
            transition: all .2s;
        }
        .input-field:focus {
            outline:none;
            border-color:#22c55e;
            box-shadow:0 0 0 3px rgba(34,197,94,0.15);
            background:#f0fdf4;
        }
        .input-field.has-error { border-color:#fca5a5; background:#fff5f5; }

        select { appearance:none; }

        /* ── BOTÕES ── */
        .btn-green {
            width:100%;
            background: linear-gradient(135deg,#22c55e,#16a34a);
            color:white;
            font-weight:800;
            font-size:15px;
            padding:15px;
            border-radius:18px;
            border:none;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            box-shadow:0 6px 20px rgba(34,197,94,0.4);
            transition: transform .15s;
        }
        .btn-green:active { transform:scale(.98); filter:brightness(0.95); }

        /* ── ÁREA DA IMAGEM ── */
        .img-area {
            width:100%;
            height:170px;
            border-radius:16px;
            border:2px dashed #86efac;
            background: linear-gradient(135deg,#f0fdf4,#dcfce7);
            cursor:pointer;
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            gap:8px;
        }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="dynamic-island"></div>

        <div class="status-bar">
            <span style="font-size:13px;font-weight:900;color:white;" id="clock">9:41</span>
            <div style="display:flex;align-items:center;gap:6px;">
                <svg width="17" height="12" viewBox="0 0 17 12" fill="white"><rect x="0" y="5" width="3" height="7" rx="1"/><rect x="4.5" y="3" width="3" height="9" rx="1"/><rect x="9" y="1" width="3" height="11" rx="1"/><rect x="13.5" y="0" width="3" height="12" rx="1" opacity=".3"/></svg>
                <svg width="25" height="12" viewBox="0 0 25 12" fill="white"><rect x=".5" y=".5" width="21" height="11" rx="3.5" stroke="white" stroke-opacity=".35"/><rect x="2" y="2" width="17" height="8" rx="2"/><path d="M23 4v4a2 2 0 000-4z" opacity=".4"/></svg>
            </div>
        </div>

        <div class="scroll-area">
            <div style="padding: 20px 16px 10px; display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('post.index') }}" style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.2); backdrop-filter:blur(8px); display:flex; align-items:center; justify-content:center; text-decoration:none;">
                    <svg width="18" height="18" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <span style="font-size:20px; font-weight:900; color:white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Novo Produto</span>
            </div>

            <div style="background:white; margin: 10px 14px 40px; padding: 20px 16px; border-radius: 28px; box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
                
                <div style="display:flex; align-items:center; gap:10px; margin-bottom: 20px;">
                    @if(auth()->check() && auth()->user()->foto_perfil)
                        <img src="{{ asset('storage/'.auth()->user()->foto_perfil) }}" style="width:44px; height:44px; border-radius:50%; object-fit:cover; border:2.5px solid #22c55e; outline:2px solid white;" />
                    @else
                        <div style="width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg,#4ade80,#16a34a); display:flex; align-items:center; justify-content:center; border:2px solid #22c55e;">
                            <span style="color:white; font-weight:900;">{{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : '?' }}</span>
                        </div>
                    @endif
                    <div>
                        <p style="font-weight:800; font-size:14px; color:#111;">{{ auth()->user()->name ?? 'Visitante' }}</p>
                        <p style="font-size:11px; color:#6b7280; font-weight:600;">📍 {{ auth()->user()->cidade ?? 'Localização' }}</p>
                    </div>
                </div>

                @if($errors->any())
                    <div style="background:#fff5f5; border:1.5px solid #fca5a5; border-radius:14px; padding:10px 12px; margin-bottom: 15px;">
                        @foreach($errors->all() as $error)
                            <p style="font-size:12px; color:#dc2626; font-weight:600;">• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:12px;">
                    @csrf

                    <div class="img-area" onclick="document.getElementById('foto').click()" id="imgArea">
                        <img id="previewImg" src="" style="width:100%;height:100%;object-fit:cover;display:none;" />
                        <div id="placeholder" style="display:flex;flex-direction:column;align-items:center;gap:4px;">
                            <div style="width:44px;height:44px;border-radius:50%;background:#dcfce7;display:flex;align-items:center;justify-content:center;">
                                <svg width="22" height="22" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p style="font-size:13px;font-weight:700;color:#16a34a;">Adicionar foto</p>
                            <p style="font-size:10px;color:#9ca3af;">JPG, PNG ou WEBP</p>
                        </div>
                    </div>
                    <input type="file" name="foto" id="foto" accept="image/*" style="display:none;" onchange="previewImage(event)" />

                    <div style="position:relative;">
                        <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                            <svg width="18" height="18" fill="#22c55e" viewBox="0 0 24 24"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58s1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41s-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/></svg>
                        </span>
                        <input type="text" name="nome" placeholder="Nome do produto" value="{{ old('nome') }}" class="input-field {{ $errors->has('nome') ? 'has-error' : '' }}" />
                    </div>

                    <div style="position:relative;">
                        <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </span>
                        <select name="selo" class="input-field {{ $errors->has('selo') ? 'has-error' : '' }}" style="color:{{ old('selo') ? '#374151' : '#9ca3af' }};" onchange="this.style.color='#374151'">
                            <option value="" disabled {{ old('selo') ? '' : 'selected' }}>Tipo de produtor (Selo)..</option>
                            <option value="autonomo" {{ old('selo')=='autonomo'?'selected':'' }}>👤 Autônomo</option>
                            <option value="empresa" {{ old('selo')=='empresa'?'selected':'' }}>🏢 Empresa</option>
                            <option value="cooperativa" {{ old('selo')=='cooperativa'?'selected':'' }}>🤝 Cooperativa</option>
                            <option value="organico" {{ old('selo')=='organico'?'selected':'' }}>🌿 Orgânico</option>
                        </select>
                    </div>

                    <div style="position:relative;">
                        <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <input type="number" name="preco_kg" placeholder="Preço por kg (R$)" value="{{ old('preco_kg') }}" step="0.01" class="input-field {{ $errors->has('preco_kg') ? 'has-error' : '' }}" />
                    </div>

                    <div style="position:relative;">
                        <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </span>
                        <input type="number" name="quantidade" placeholder="Quantidade total (kg)" value="{{ old('quantidade') }}" step="0.1" class="input-field {{ $errors->has('quantidade') ? 'has-error' : '' }}" />
                    </div>

                    <div style="position:relative;">
                        <span style="position:absolute;left:13px;top:14px;">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </span>
                        <textarea name="descricao" rows="2" placeholder="Descrição do Produto" class="input-field {{ $errors->has('descricao') ? 'has-error' : '' }}" style="resize:none; padding-top:13px;">{{ old('descricao') }}</textarea>
                    </div>

                    <button type="submit" class="btn-green" style="margin-top:5px;">
                        <svg width="20" height="20" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Publicar Produto
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('previewImg').style.display = 'block';
            document.getElementById('placeholder').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function tick() {
        const d = new Date();
        document.getElementById('clock').textContent = `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
    }
    tick();
    setInterval(tick, 10000);
</script>
</body>
</html>