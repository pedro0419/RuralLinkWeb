<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Rural Link - Cadastro</title>
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body {
            height: 100vh;
            background: #0f172a; 
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        /* Tamanho igual às outras telas */
        .phone {
            position: relative;
            width: 375px;
            height: 760px;
            background: #1a1a1a;
            border-radius: 52px;
            padding: 12px;
            box-shadow: 0 0 0 2px #3a3a3a, 0 40px 80px rgba(0,0,0,0.7);
        }
        .screen {
            width: 100%;
            height: 100%;
            background: #ffffff; 
            border-radius: 40px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        .input-box {
            width: 100%;
            height: 44px;
            background: #f3f4f6;
            border-radius: 12px;
            padding: 0 42px;
            font-size: 13px;
            outline: none;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }
        .input-box:focus { 
            border-color: #3D6B35; 
            background: white;
            box-shadow: 0 0 0 4px rgba(61, 107, 53, 0.05);
        }
        
        .label-style {
            color: #3D6B35;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: 4px;
            margin-left: 4px;
            display: block;
        }

        .form-container::-webkit-scrollbar { width: 4px; }
        .form-container::-webkit-scrollbar-thumb { background: #3D6B35; border-radius: 10px; }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="absolute top-3 left-1/2 -translate-x-1/2 w-28 h-7 bg-black rounded-3xl z-50"></div>

        <div class="relative z-10 flex justify-center pt-10">
            <img src="{{ asset('assets/RuralLinkpreto.png') }}" alt="Rural Link" class="h-20 w-auto object-contain">
        </div>

        <div class="relative z-10 flex-1 flex flex-col items-center px-6 pb-6 w-full overflow-hidden">
            <h1 class="text-[#3D6B35] text-2xl font-bold text-center mb-6">Criar Conta</h1>

            <div class="bg-white w-full overflow-y-auto form-container pr-1">
                
                @if ($errors->any())
                    <div class="mb-4 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg border border-red-100">
                        @foreach ($errors->all() as $erro)
                            <p>• {{ $erro }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('registro.post') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="label-style">Nome Completo</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-gray-400">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            <input type="text" name="name" value="{{ old('name') }}" class="input-box" placeholder="Ex: João Silva" required>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">E-mail</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-gray-400">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" class="input-box" placeholder="seu@email.com" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label-style">Telefone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="(00) 00000-0000" maxlength="15" oninput="mascaraTelefone(this)" class="input-box !px-4" required>
                        </div>
                        <div>
                            <label class="label-style">Cidade</label>
                            <input type="text" name="location" value="{{ old('location') }}" placeholder="Sua cidade" class="input-box !px-4" required>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">Senha</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center text-gray-400">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 118 0v4"/></svg>
                            </span>
                            <input type="password" name="password" id="cadPass" class="input-box" placeholder="••••••••" required>
                            <button type="button" onclick="toggleCadPass()" class="absolute inset-y-0 right-3.5 flex items-center text-gray-400">
                                <svg id="eyeIcon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path id="eyePath" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" class="input-box !px-4" placeholder="Repita a senha" required>
                    </div>

                    <div>
                        <label class="label-style">Foto de Perfil <span class="font-normal opacity-60">(Opcional)</span></label>
                        <input type="file" name="profile_image" accept="image/*" class="text-[11px] text-gray-500 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-[#3D6B35] hover:file:bg-green-100">
                    </div>

                    <button type="submit" class="w-full bg-[#3D6B35] text-white font-bold h-14 rounded-2xl shadow-lg active:scale-[0.98] transition-all text-base mt-2">
                        Cadastrar Agora
                    </button>

                    <div class="text-center pt-2">
                        <p class="text-xs text-gray-500">Já tem uma conta? <a href="{{ route('login') }}" class="text-[#3D6B35] font-bold hover:underline">Entre aqui.</a></p>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-32 h-1.5 bg-gray-200 rounded-full"></div>
    </div>
</div>

<script>
    function mascaraTelefone(input) {
        let v = input.value.replace(/\D/g, '');
        if (v.length <= 10) {
            v = v.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        } else {
            v = v.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
        }
        input.value = v;
    }

    function toggleCadPass() {
        const input = document.getElementById('cadPass');
        const path = document.getElementById('eyePath');
        const eyeOpen = "M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z M12 15a3 3 0 100-6 3 3 0 000 6z";
        const eyeClosed = "M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18";

        if (input.type === 'password') {
            input.type = 'text';
            path.setAttribute('d', eyeOpen);
        } else {
            input.type = 'password';
            path.setAttribute('d', eyeClosed);
        }
    }
</script>

</body>
</html>