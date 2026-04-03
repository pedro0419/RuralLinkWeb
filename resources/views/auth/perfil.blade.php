{{-- resources/views/auth/perfil.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - {{ $user->name }}</title>
    <style>
        body { margin-bottom: 60px; }
        .nav-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 1px solid #ccc;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }
        .nav-bottom a { text-decoration: none; color: #333; }
    </style>
</head>
<body>

    <h1>{{ $user->name }}</h1>

    @if ($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Foto de perfil" width="100">
    @endif

    <p><strong>Descrição:</strong> {{ $user->description ?? 'Sem descrição.' }}</p>
    <p><strong>Localização:</strong> {{ $user->location }}</p>
    <p><strong>Telefone:</strong> {{ $user->phone }}</p>

    <hr>

    <a href="{{ route('perfil.edit') }}">Editar perfil</a>

    <hr>

    <h2>Postagens</h2>

    <a href="{{ route('post.create') }}">+ Nova postagem</a>

    <br><br>

    @forelse ($user->postagens as $postagen)
        <div>
            <h3>{{ $postagen->nome }}</h3>
            <p>{{ $postagen->descricao }}</p>

            <form action="{{ route('post.delete', $postagen->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tem certeza que deseja deletar?')">
                    Deletar
                </button>
            </form>
        </div>
        <hr>
    @empty
        <p>Nenhuma postagem ainda.</p>
    @endforelse

    {{-- Barra de navegação inferior --}}
    <nav class="nav-bottom">
        <a href="{{ route('post.index') }}">🏠 Início</a>
        <a href="{{ route('favoritos.index') }}">★ Salvos</a>
        <a href="{{ route('perfil.show') }}">👤 Perfil</a>
    </nav>

</body>
</html>