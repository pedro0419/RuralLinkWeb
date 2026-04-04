<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rural Link - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        
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
            width: 320px;
            height: 600px;
            background: #1a1a1a;
            border-radius: 45px;
            padding: 10px;
            box-shadow: 0 0 0 2px #3a3a3a, 0 30px 60px rgba(0,0,0,0.8);
        }

        .screen {
            width: 100%;
            height: 100%;
            background: #000;
            border-radius: 35px;
            overflow: hidden;
            position: relative;
        }

        .main-content {
            height: 100%;
            width: 100%;
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.5)), 
                        url("{{ asset('assets/Untitled design (16).png') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            padding: 25px 20px 45px;
        }

        .input-login {
            width: 100%;
            height: 42px;
            background: white;
            border-radius: 10px;
            padding: 0 42px;
            outline: none;
            color: #333;
            font-size: 13px;
        }

        .btn-entrar {
            width: 100%;
            height: 42px;
            background: #3D6B35;
            color: white;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.2s;
            margin-top: 10px;
        }

        .btn-entrar:active { transform: scale(0.96); }

        .home-indicator {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="phone">
    <div class="screen">
        <div class="absolute top-2 left-1/2 -translate-x-1/2 w-20 h-5 bg-black rounded-full z-50"></div>
        
        <div class="main-content">
            <div class="flex justify-start -mt-3 -ml-3">
                <img src="{{ asset('assets/RuralLink.png') }}" alt="Rural Link" class="h-32 w-auto object-contain">
            </div>

            <div class="flex-1 flex flex-col justify-center">
                <h1 class="text-white text-6xl font-bold text-center mb-4 tracking-tight">Login</h1>
                
                {{-- Exibição de Erros --}}
                @if ($errors->any())
                    <div class="mb-4 text-red-400 text-xs text-center font-semibold">
                        @foreach ($errors->all() as $erro)
                            <p>{{ $erro }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="flex flex-col gap-4">
                    @csrf

                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <input type="email" name="email" class="input-login" placeholder="Email" value="{{ old('email') }}" required>
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 118 0v4"/></svg>
                        </span>
                        <input type="password" name="password" id="passInput" class="input-login" placeholder="Senha" required>
                        <button type="button" onclick="togglePass()" class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                            <svg id="eyeIcon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path id="eyePath" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-2 px-1">
                        <input type="checkbox" name="lembrar" id="lembrar" class="rounded border-gray-300">
                        <label for="lembrar" class="text-white text-[10px] cursor-pointer">Lembrar de mim</label>
                    </div>

                    <button type="submit" class="btn-entrar">
                        Entrar
                    </button>
                </form>
            </div>

            <div class="text-center">
                <p class="text-white text-xs">
                    Não tem uma conta? <a href="{{ route('registro') }}" class="text-[#00C2FF] font-bold">Cadastre-se!</a>
                </p>
            </div>
        </div>

        <div class="home-indicator"></div>
    </div>
</div>

<script>
    function togglePass() {
        const input = document.getElementById('passInput');
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