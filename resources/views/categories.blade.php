@extends("layout")
@section("pageTitle", "Categorias.")
@section("content")
<h1>Categorias</h1>
<a href="{{ route('home') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>
<a href="{{ route('categories.create') }}"><button class="editar-excluir">Incluir Categoria<i class="fa-solid fa-plus"></i></button></a>
    <!-- Mensagem de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
<table class="tabela">
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    @foreach($categories as $categorie)
    <tr>
        <td>{{ $categorie->id }}</td>
        <td>{{ $categorie->name }}</td>
        <td>{{ $categorie->description }}</td>
        <td>
            <a href="{{ route('categories.edit', ['id' => $categorie->id]) }}"><button class="editar-excluir">Editar<i class="fa-solid fa-pen-to-square"></i></button></a>
            <br>
            <form action="{{ route('categories.destroy', ['id' => $categorie->id]) }}" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" class="editar-excluir">Excluir<i class="fa-solid fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection