@extends("layout")
@section("pageTitle", "Marcas.")
@section("content")
<h1>Marcas</h1>
<a href="{{ route('home') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>
<a href="{{ route('brands.create') }}"><button class="editar-excluir">Incluir Marca<i class="fa-solid fa-plus"></i></button></a>

<table class="tabela">
    <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Logomarca</th>
        <th>Ações</th>

    </tr>
    @foreach($brands as $brand)
    <tr>
        <td>{{ $brand->id }}</td>
        <td>{{ $brand->name }}</td>
        <td>
        @if($brand->photo)
            <img src="{{ asset('storage/' . $brand->photo) }}" alt="{{ $brand->name }}">
        @endif
        </td>
        <td>
            <a href="{{ route('brands.edit', ['id' => $brand->id]) }}"><button class="editar-excluir">Editar  <i class="fa-solid fa-pen-to-square"></i></button></a>
            <br>
            <form action="{{ route('brands.destroy', ['id' => $brand->id]) }}" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" class="editar-excluir">Excluir<i class="fa-solid fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection