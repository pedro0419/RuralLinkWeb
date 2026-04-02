{{-- resources/views/auth/edit-perfil.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
 
    <h1>Editar Perfil</h1>
 
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
 
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
 
    <form action="{{ route('perfil.update') }}" method="POST">
        @csrf
        @method('PUT')
 
        <div>
            <label for="name">Nome</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
        </div>
 
        <div>
            <label for="description">Descrição</label><br>
            <textarea id="description" name="description" rows="4">{{ old('description', $user->description) }}</textarea>
        </div>
 
        <div>
            <label for="location">Localização</label><br>
            <input type="text" id="location" name="location" value="{{ old('location', $user->location) }}">
        </div>
 
        <div>
            <label for="phone">Telefone</label><br>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>
 
        <br>
        <a href="{{ route('post.index') }}">Cancelar</a>
        <button type="submit">Salvar alterações</button>
 
    </form>
 
</body>
</html>