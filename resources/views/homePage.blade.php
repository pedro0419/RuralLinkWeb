<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
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
    <form method="GET" action="{{ route('post.index') }}">
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
            <a href="{{ route('post.index') }}">Limpar filtros</a>
        @endif
    </form>

    @if (!isset($posts))
        @php $posts = collect(); @endphp
    @endif

    @if ($posts->isEmpty())
        <p>Nenhum produto cadastrado ainda.</p>
    @else
        @foreach ($posts as $post)
            <div>
                <img src="{{ asset('storage/' . $post->foto) }}" alt="{{ $post->nome }}">
                <h2>{{ $post->nome }}</h2>
                <p>Selo: {{ $post->selo }}</p>
                <p>Preço: R$ {{ number_format($post->preco_kg, 2, ',', '.') }} / kg</p>
                <p>Quantidade: {{ $post->quantidade }} kg</p>
                <p>{{ $post->descricao }}</p>

                @auth
                    <form action="{{ route('favoritos.toggle', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit">
                            {{ Auth::user()->favoritos->contains($post->id) ? '★ Salvo' : '☆ Salvar' }}
                        </button>
                    </form>
                @endauth
            </div>
        @endforeach
    @endif

    {{-- Barra de navegação inferior --}}
    <nav class="nav-bottom">
        <a href="{{ route('post.index') }}">🏠 Início</a>
        @auth
            <a href="{{ route('favoritos.index') }}">★ Salvos</a>
            <a href="{{ route('perfil.show') }}">👤 Perfil</a>
        @endauth
        @guest
            <a href="{{ route('login') }}">Entrar</a>
        @endguest
    </nav>

</body>
</html>