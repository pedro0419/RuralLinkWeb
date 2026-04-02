<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Procurar Produtos</title>
</head>
<body>

    <h1>Procurar Produtos</h1>

    <form method="GET" action="{{ route('procurar.index') }}">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Buscar por nome, descrição, preço..."
        >

        <select name="selo">
            <option value="">Todos os selos</option>
            <option value="organico"      {{ ($selo ?? '') == 'organico'      ? 'selected' : '' }}>Orgânico</option>
            <option value="natural"       {{ ($selo ?? '') == 'natural'       ? 'selected' : '' }}>Natural</option>
            <option value="agroecologico" {{ ($selo ?? '') == 'agroecologico' ? 'selected' : '' }}>Agroecológico</option>
            <option value="convencional"  {{ ($selo ?? '') == 'convencional'  ? 'selected' : '' }}>Convencional</option>
        </select>

        <button type="submit">Buscar</button>
    </form>

    <hr>

    @if($resultados->isEmpty())
        <p>Nenhum resultado encontrado.</p>
    @else
        <p>{{ $resultados->count() }} resultado(s) encontrado(s).</p>

        @foreach($resultados as $post)
            <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">

                @if($post['foto'])
                    <img src="{{ asset('storage/' . $post['foto']) }}"
                         alt="{{ $post['nome'] }}"
                         style="width: 200px; height: auto;">
                @endif

                <h2>{{ $post['nome'] }}</h2>
                <p><strong>Selo:</strong> {{ ucfirst($post['selo']) }}</p>
                <p><strong>Preço/kg:</strong> R$ {{ number_format($post['preco_kg'], 2, ',', '.') }}</p>
                <p><strong>Quantidade:</strong> {{ $post['quantidade'] }} kg</p>
                <p><strong>Descrição:</strong> {{ $post['descricao'] }}</p>
                <p><strong>Vendedor:</strong> {{ $post['user_name'] }} | {{ $post['user_phone'] }}</p>
                <small>Publicado em: {{ $post['created_at'] }}</small>

            </div>
        @endforeach
    @endif

</body>
</html>