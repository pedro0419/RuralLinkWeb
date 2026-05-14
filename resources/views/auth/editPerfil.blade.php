{{-- resources/views/auth/edit-perfil.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Nunito', sans-serif; box-sizing: border-box; }
        body { min-height:100vh; margin:0; background:#0f172a; display:flex; align-items:center; justify-content:center; padding:32px 16px; }
        .phone { position:relative; width:375px; background:#1a1a1a; border-radius:52px; padding:14px; box-shadow:0 0 0 2px #3a3a3a,0 0 0 4px #111,0 40px 80px rgba(0,0,0,0.7),inset 0 0 0 1px rgba(255,255,255,0.06); animation:phoneIn 0.6s cubic-bezier(.22,1,.36,1) both; }
        @keyframes phoneIn { from{opacity:0;transform:translateY(32px) scale(.96)} to{opacity:1;transform:translateY(0) scale(1)} }
        .screen { width:100%; background:#f3f4f6; border-radius:40px; overflow:hidden; display:flex; flex-direction:column; height:720px; position:relative; }
        .dynamic-island { position:absolute; top:12px; left:50%; transform:translateX(-50%); width:110px; height:30px; background:#111; border-radius:20px; z-index:50; pointer-events:none; }
        .status-bar { padding:44px 20px 10px; display:flex; justify-content:space-between; align-items:center; position:relative; z-index:60; background:#15803d; flex-shrink:0; }
        .scroll-area { flex:1; overflow-y:auto; scrollbar-width:none; background:#f3f4f6; }
        .scroll-area::-webkit-scrollbar { display:none; }
        .avatar-wrap { width:100px; height:100px; border-radius:50%; position:relative; margin:0 auto; cursor:pointer; }
        .avatar-wrap img, .avatar-placeholder { width:100px; height:100px; border-radius:50%; object-fit:cover; border:3.5px solid white; box-shadow:0 6px 20px rgba(0,0,0,0.15); }
        .avatar-placeholder { background:linear-gradient(135deg,#4ade80,#16a34a); display:flex; align-items:center; justify-content:center; }
        .input-field { width:100%; background:#f8fafb; border:1.5px solid #e5e7eb; border-radius:16px; padding:13px 14px 13px 42px; font-size:14px; color:#374151; font-weight:600; transition:all .2s; font-family:'Nunito',sans-serif; }
        .input-field:focus { outline:none; border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.15); background:#f0fdf4; }
        .input-field.has-error { border-color:#fca5a5; background:#fff5f5; }
        .btn-green { width:100%; background:linear-gradient(135deg,#22c55e,#16a34a); color:white; font-weight:800; font-size:15px; padding:15px; border-radius:18px; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 6px 20px rgba(34,197,94,0.4); transition:transform .15s; font-family:'Nunito',sans-serif; }
        .btn-green:active { transform:scale(.98); }
        .btn-photo { background:linear-gradient(135deg,#22c55e,#16a34a); color:white; font-weight:800; font-size:13px; padding:10px 20px; border-radius:14px; border:none; cursor:pointer; display:inline-flex; align-items:center; gap:7px; box-shadow:0 4px 14px rgba(34,197,94,0.35); font-family:'Nunito',sans-serif; }
        .section-label { font-size:12px; font-weight:800; color:#9ca3af; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px; padding-left:2px; }
    </style>
</head>
<body>
<div class="phone">
  <div class="screen">
    <div class="dynamic-island"></div>

    <div class="status-bar">
      <div style="display:flex;align-items:center;gap:10px;">
        <a href="{{ route('perfil.show') }}"
           style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;text-decoration:none;flex-shrink:0;">
          <svg width="16" height="16" fill="none" stroke="white" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
          </svg>
        </a>
        <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" style="height:44px;object-fit:contain;">
      </div>
      <div style="display:flex;align-items:center;gap:10px;">
        <span style="font-size:12px;font-weight:900;color:white;" id="clock">9:41</span>
        <div style="display:flex;align-items:center;gap:6px;">
          <svg width="17" height="12" viewBox="0 0 17 12" fill="white"><rect x="0" y="5" width="3" height="7" rx="1"/><rect x="4.5" y="3" width="3" height="9" rx="1"/><rect x="9" y="1" width="3" height="11" rx="1"/><rect x="13.5" y="0" width="3" height="12" rx="1" opacity=".3"/></svg>
          <svg width="25" height="12" viewBox="0 0 25 12" fill="white"><rect x=".5" y=".5" width="21" height="11" rx="3.5" stroke="white" stroke-opacity=".35"/><rect x="2" y="2" width="17" height="8" rx="2"/></svg>
        </div>
      </div>
    </div>

    <div class="scroll-area">
      <div style="margin:10px 14px 28px;background:white;border-radius:28px;padding:24px 18px;box-shadow:0 10px 30px rgba(0,0,0,0.1);">

        <div style="display:flex;flex-direction:column;align-items:center;gap:14px;margin-bottom:24px;">
          <div class="avatar-wrap" onclick="document.getElementById('foto_perfil').click()">
            @if($user->profile_image)
              <img id="avatarPreview" src="{{ Storage::url($user->profile_image) }}" />
            @else
              <div class="avatar-placeholder" id="avatarPlaceholder">
                <span style="color:white;font-weight:900;font-size:36px;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
              </div>
              <img id="avatarPreview" src="" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3.5px solid white;box-shadow:0 6px 20px rgba(0,0,0,0.15);display:none;" />
            @endif
          </div>

          <input type="file" name="profile_image" id="foto_perfil" form="formPerfil" accept="image/*" style="display:none;" onchange="previewAvatar(event)" />

          <button type="button" class="btn-photo" onclick="document.getElementById('foto_perfil').click()">
            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Foto de perfil
          </button>
        </div>

        @if($errors->any())
          <div style="background:#fff5f5;border:1.5px solid #fca5a5;border-radius:14px;padding:10px 12px;margin-bottom:16px;">
            @foreach($errors->all() as $error)
              <p style="font-size:12px;color:#dc2626;font-weight:600;margin:0;">• {{ $error }}</p>
            @endforeach
          </div>
        @endif

        @if(session('success'))
          <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:14px;padding:10px 12px;margin-bottom:16px;">
            <p style="font-size:12px;color:#16a34a;font-weight:700;margin:0;">{{ session('success') }}</p>
          </div>
        @endif

        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data" id="formPerfil" style="display:flex;flex-direction:column;gap:14px;">
          @csrf
          @method('PUT')

          <div>
            <p class="section-label">Nome de usuário:</p>
            <div style="position:relative;">
              <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <input type="text" name="name" placeholder="Nome" value="{{ old('name', $user->name) }}" class="input-field {{ $errors->has('name') ? 'has-error' : '' }}" />
            </div>
          </div>

          <div>
            <p class="section-label">Telefone:</p>
            <div style="position:relative;">
              <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              </span>
              <input type="tel" name="phone" placeholder="Telefone" value="{{ old('phone', $user->phone) }}" class="input-field {{ $errors->has('phone') ? 'has-error' : '' }}" />
            </div>
          </div>

          <div>
            <p class="section-label">Localização:</p>
            <div style="position:relative;">
              <span style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
              </span>
              <input type="text" name="location" placeholder="Cidade / Região" value="{{ old('location', $user->location) }}" class="input-field {{ $errors->has('location') ? 'has-error' : '' }}" />
            </div>
          </div>

          <div>
            <p class="section-label">Descrição de perfil:</p>
            <div style="position:relative;">
              <span style="position:absolute;left:13px;top:14px;">
                <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
              </span>
              <textarea name="description" rows="3" placeholder="Escreva sobre você..." class="input-field {{ $errors->has('description') ? 'has-error' : '' }}" style="resize:none;padding-top:13px;">{{ old('description', $user->description) }}</textarea>
            </div>
          </div>

          <button type="button" onclick="confirmarDelete()" style="width:100%;background:white;color:#ef4444;font-weight:800;font-size:15px;padding:15px;border-radius:18px;border:1.5px solid #fca5a5;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;margin-top:4px;">
            <svg width="18" height="18" fill="none" stroke="#ef4444" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Deletar conta
          </button>

          <button type="submit" class="btn-green" style="margin-top:4px;">
            <svg width="18" height="18" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Salvar
          </button>

          <a href="{{ route('perfil.show') }}" style="text-align:center;font-size:13px;font-weight:700;color:#9ca3af;text-decoration:none;padding:4px 0;">
            Cancelar
          </a>

        </form>

        <form id="formDelete" action="{{ route('perfil.destroy') }}" method="POST" style="display:none;">
          @csrf
          @method('DELETE')
        </form>

      </div>
    </div>
  </div>
</div>

<script>
  function tick() {
    const d = new Date();
    document.getElementById('clock').textContent =
      `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}`;
  }
  tick();
  setInterval(tick, 10000);

  function previewAvatar(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
      const preview = document.getElementById('avatarPreview');
      const placeholder = document.getElementById('avatarPlaceholder');
      preview.src = ev.target.result;
      preview.style.display = 'block';
      if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }

  function confirmarDelete() {
    if (confirm('Tem certeza que deseja deletar sua conta? Essa ação não pode ser desfeita.')) {
      document.getElementById('formDelete').submit();
    }
  }
</script>
</body>
</html>