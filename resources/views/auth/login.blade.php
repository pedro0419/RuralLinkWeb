<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rural Link - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { height: 100vh; background: #0f172a; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        
        .phone { 
            position: relative; width: 375px; height: 760px; background: #1a1a1a; 
            border-radius: 52px; padding: 12px; 
            box-shadow: 0 0 0 2px #3a3a3a, 0 40px 80px rgba(0,0,0,0.7);
        }

        .screen { 
            width: 100%; height: 100%; border-radius: 40px; overflow: hidden; position: relative; 
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.6)), url("{{ asset('assets/bg-login.png') }}");
            background-size: cover; background-position: center;
        }

        .input-login { 
            width: 100%; height: 52px; 
            background: white; 
            border-radius: 14px; padding: 0 48px; 
            outline: none; color: #1f2937; font-size: 14px; 
            border: 1px solid #e5e7eb; transition: all 0.2s ease;
        }
        
        .input-login:focus { 
            border-color: #3D6B35; 
            box-shadow: 0 0 0 4px rgba(61, 107, 53, 0.1);
        }

        /* Botão Flat e Sólido - Sem brilhos de IA */
        .btn-entrar { 
            width: 100%; height: 54px; 
            background: #3D6B35; 
            color: white; border-radius: 14px; 
            font-weight: 600; font-size: 16px; 
            margin-top: 12px; border: none; cursor: pointer;
            transition: background 0.2s;
        }

        .btn-entrar:hover { background: #2d5227; }
        .btn-entrar:active { transform: scale(0.98); }

        .icon-container {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            color: #9ca3af; pointer-events: none;
        }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="absolute top-3 left-1/2 -translate-x-1/2 w-28 h-7 bg-black rounded-3xl z-50"></div>
        
        <div class="flex flex-col h-full p-8">
            <div class="flex justify-center mt-6">
                <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" class="h-20 w-auto object-contain">
            </div>

            <div class="flex-1 flex flex-col justify-center">
                <div class="mb-10 text-center">
                    <h1 class="text-white text-3xl font-bold tracking-tight">Bem-vindo</h1>
                    <p class="text-gray-300 text-sm mt-1">Acesse sua conta Rural Link</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 text-red-400 text-xs text-center font-medium bg-black/60 p-3 rounded-xl border border-red-500/20">
                        @foreach ($errors->all() as $erro) <p>{{ $erro }}</p> @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="relative">
                        <span class="icon-container">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="email" name="email" class="input-login" placeholder="E-mail" value="{{ old('email') }}" required>
                    </div>

                    <div class="relative">
                        <span class="icon-container">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 10-8 0v4"/></svg>
                        </span>
                        <input type="password" name="password" id="loginPass" class="input-login" placeholder="Senha" required>
                        
                        <button type="button" onclick="toggleLoginPass()" class="absolute inset-y-0 right-4 flex items-center text-gray-400">
                            <svg id="eyeIcon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path id="eyePath" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="btn-entrar">Entrar na plataforma</button>
                </form>
            </div>

            <div class="text-center mt-auto pb-4">
                <p class="text-white/80 text-sm">
                    Ainda não tem conta? 
                    <a href="{{ route('registro') }}" class="text-[#4ade80] font-bold">Cadastre-se</a>
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-32 h-1.5 bg-white/20 rounded-full"></div>
    </div>
</div>

<script>
    function toggleLoginPass() {
        const input = document.getElementById('loginPass');
        const path = document.getElementById('eyePath');
        
        // Paths extraídos do seu código de registro
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