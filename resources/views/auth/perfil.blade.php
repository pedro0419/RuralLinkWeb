{{-- resources/views/auth/perfil.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - {{ $user->name }}</title>
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
            <h3>{{ $postagen->title }}</h3>
            <p>{{ $postagen->description }}</p>
            
        </div>
        <hr>
    @empty
        <p>Nenhuma postagem ainda.</p>
    @endforelse

</body>
</html>