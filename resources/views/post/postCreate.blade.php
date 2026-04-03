<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poste de produtos</title>
</head>
<body>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
            @if (auth()->user()->profile_image)
            <img 
                src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
                width="40"
                style="border-radius:50%; object-fit:cover;"
            >
            @endif

            <span>{{ auth()->user()->name }}</span>
        </div>

        <input type="file" name="foto" accept="image/*">

        <input type="text" name="nome" placeholder="Nome do produto">

        <select name="selo">
            <option value="">Selo do produto...</option>
            <option value="organico">Orgânico</option>
            <option value="natural">Natural</option>
            <option value="agroecologico">Agroecológico</option>
            <option value="convencional">Convencional</option>
        </select>

        <input type="number" name="preco_kg" placeholder="Preço por kg (R$)" step="0.01">
        <input type="number" name="quantidade" placeholder="Quantidade disponível (kg)" step="0.1">
        <textarea name="descricao" placeholder="Descrição do Produto"></textarea>

        <button type="submit">Publicar Produto</button>
    </form>

    {{-- Exibir erros de validação --}}
    @if ($errors->any())
        @foreach ($errors->all() as $erro)
            <p style="color:red">{{ $erro }}</p>
        @endforeach
    @endif
</body>
</html>
