{{-- resources/views/favoritos/index.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvos</title>
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

    <h1>Salvos</h1>

    <br><br>

    <form method="GET" action="{{ route('favoritos.index') }}">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar por nome, descrição, selo..."
        >

        <select name="selo">
            <option value="">Todos os selos</option>
            <option value="organico"      {{ request('selo') == 'organico'      ? 'selected' : '' }}>Orgânico</option>
            <option value="natural"       {{ request('selo') == 'natural'       ? 'selected' : '' }}>Natural</option>
            <option value="agroecologico" {{ request('selo') == 'agroecologico' ? 'selected' : '' }}>Agroecológico</option>
            <option value="convencional"  {{ request('selo') == 'convencional'  ? 'selected' : '' }}>Convencional</option>
        </select>

        <button type="submit">Buscar</button>
        @if(request('search') || request('selo'))
            <a href="{{ route('favoritos.index') }}">Limpar filtros</a>
        @endif
    </form>

    @forelse ($favoritos as $postagem)
        <div>
            @if ($postagem->foto)
                <img src="{{ asset('storage/' . $postagem->foto) }}" alt="{{ $postagem->nome }}" width="100">
            @endif

            <h3>{{ $postagem->nome }}</h3>
            <p>{{ $postagem->descricao }}</p>
            <p><strong>Preço/kg:</strong> R$ {{ $postagem->preco_kg }}</p>
            <p><strong>Quantidade:</strong> {{ $postagem->quantidade }}</p>

            <form action="{{ route('favoritos.toggle', $postagem->id) }}" method="POST">
                @csrf
                <button type="submit">★ Remover dos salvos</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Nenhum item salvo ainda.</p>
    @endforelse

    {{-- Barra de navegação inferior --}}
    <nav class="nav-bottom">
        <a href="{{ route('post.index') }}">🏠 Início</a>
        <a href="{{ route('favoritos.index') }}">★ Salvos</a>
        <a href="{{ route('perfil.show') }}">👤 Perfil</a>
    </nav>

</body>
</html>