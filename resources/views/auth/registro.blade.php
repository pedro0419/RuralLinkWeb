<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
</head>
<body>

    <h1>Criar Conta</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('registro.post') }}" enctype="multipart/form-data">
        @csrf

        <label>Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Telefone</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>

        <label>Localização</label>
        <input type="text" name="location" value="{{ old('location') }}" required>

        <label>Senha</label>
        <input type="password" name="password" required>

        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation" required>

        <label>Foto de Perfil (opcional)</label>
        <input type="file" name="profile_image" accept="image/*">

        <label>Descrição (opcional)</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <button type="submit">Criar Conta</button>

        <p>Já tem conta? <a href="{{ route('login') }}">Entrar</a></p>

    </form>

</body>
</html>