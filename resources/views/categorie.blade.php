@extends("layout")
@section("pageTitle", "Nova categoria")
@section("content")
    <h1>Nova Marca</h1>
    <a href="{{ route('categories.index') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>
    @if($categorie->id)
    <form action="{{ route('categories.update', ['id' => $categorie->id]) }}" class="formulario" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
    <form action="{{ route('categories.store') }}" method="POST" class="formulario" enctype="multipart/form-data">
    @endif
        @csrf
        <label for="name">Nome:</label>
        <br>
        <input type="text" name="name" id="name" value="{{ $categorie->name }}">
        <br>
        <label for="description">Descrição:</label>
        <br>
        <input type="text" name="description" id="description"  value="{{ $categorie->description }}">
        <br><br>
        <button type="submit">Salvar</button>
    </form>
@endsection