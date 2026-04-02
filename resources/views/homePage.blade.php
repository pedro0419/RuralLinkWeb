<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
</head>
<body>
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
            </div>
        @endforeach
    @endif
</body>
</html>
