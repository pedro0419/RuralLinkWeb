<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Entrar</title>
</head>
<body>

    <h1>Entrar</h1>

    {{-- Erros --}}
    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <label>E-mail</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <label>Senha</label>
        <input
            type="password"
            name="password"
            required
        >

        <label>
            <input type="checkbox" name="lembrar">
            Lembrar de mim
        </label>

        <button type="submit">Entrar</button>

    </form>

</body>
</html>