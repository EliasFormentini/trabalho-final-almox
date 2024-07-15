@extends("layout")
@section("pageTitle", "Nova marca.")
@section("content")
    <h1>Nova Marca</h1>
    <a href="{{ route('brands.index') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>
    @if($brand->id)
    <form action="{{ route('brands.update', ['id' => $brand->id]) }}" class="formulario" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
    <form action="{{ route('brands.store') }}" method="POST" class="formulario" enctype="multipart/form-data">
    @endif
        @csrf
        <label for="name">Nome:</label>
        <br>
        <input type="text" name="name" id="name" value="{{ $brand->name }}">
        <br>
        <label for="logomarca">Logomarca:</label>
        <br>
        <input type="file" name="logomarca" id="logomarca">
        <br>
        <button type="submit">Salvar</button>
    </form>
@endsection