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
        .phone {
            position: relative;
            width: 335px;
            height: 630px;
            background: #1a1a1a;
            border-radius: 45px;
            padding: 10px;
            box-shadow: 0 0 0 2px #3a3a3a, 0 30px 60px rgba(0,0,0,0.8);
        }
        .screen {
            width: 100%;
            height: 100%;
            background: url("{{ asset('assets/Untitled design (17).png') }}"); 
            background-size: cover;
            background-position: center;
            border-radius: 35px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.2);
        }
        .input-box {
            width: 100%;
            height: 38px;
            background: #f3f4f6;
            border-radius: 10px;
            padding: 0 38px;
            font-size: 12px;
            outline: none;
            border: 1px solid transparent;
            font-weight: 400;
        }
        .input-box:focus { border-color: #346631; }
        
        .label-style {
            color: #346631;
            font-weight: 600;
            font-size: 11px;
            margin-bottom: 2px;
            display: block;
        }

        /* Scrollbar suave para o formulário se necessário */
        .form-container::-webkit-scrollbar { width: 4px; }
        .form-container::-webkit-scrollbar-thumb { background: #346631; border-radius: 10px; }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="overlay"></div>
        
        <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-5 bg-black rounded-full z-50"></div>

        <div class="relative z-10 flex justify-start pt-6 pl-4">
            <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" class="h-20 w-auto object-contain">
        </div>

        <div class="relative z-10 flex-1 flex flex-col items-center p-5 w-full overflow-hidden">
            <h1 class="text-[#346631] text-2xl font-extrabold text-center mb-4">Cadastre-se!</h1>

            <div class="bg-white rounded-2xl p-5 shadow-2xl border border-gray-100 w-full overflow-y-auto form-container">
                
                {{-- Erros do Laravel --}}
                @if ($errors->any())
                    <div class="mb-4 text-red-500 text-[10px] font-bold">
                        @foreach ($errors->all() as $erro)
                            <p>* {{ $erro }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('registro.post') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf

                    <div>
                        <label class="label-style">Nome Completo:</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </span>
                            <input type="text" name="name" value="{{ old('name') }}" class="input-box" required>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">Email:</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" class="input-box" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="label-style">Telefone:</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="input-box !px-3" required>
                        </div>
                        <div>
                            <label class="label-style">Localização:</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="input-box !px-3" required>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">Senha:</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 118 0v4"/></svg>
                            </span>
                            <input type="password" name="password" id="cadPass" class="input-box" required>
                            <button type="button" onclick="toggleCadPass()" class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <svg id="eyeIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path id="eyePath" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="label-style">Confirmar Senha:</label>
                        <input type="password" name="password_confirmation" class="input-box !px-3" required>
                    </div>

                    <div>
                        <label class="label-style">Foto de Perfil (Opcional):</label>
                        <input type="file" name="profile_image" accept="image/*" class="text-[10px] text-gray-500">
                    </div>

                    <div class="text-center py-1">
                        <p class="text-[10px] text-gray-500">Já tem uma conta? <a href="{{ route('login') }}" class="text-cyan-600 font-bold">Entre aqui.</a></p>
                    </div>

                    <button type="submit" class="w-full bg-[#346631] text-white font-bold py-3 rounded-xl shadow-lg active:scale-95 transition-all text-sm">
                        Criar Conta
                    </button>
                </form>
            </div>
        </div>
        
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-24 h-1 bg-gray-300 rounded-full"></div>
    </div>
</div>

<script>
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
