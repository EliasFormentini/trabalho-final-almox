@extends("layout")
@section("pageTitle", "Produtos")
@section("content")
<h1>Produtos</h1>
<a href="{{ route('home') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>

<table class="tabela">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Foto</th>
        <th>Estoque</th>
        <th>Ações</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>
        @if($product->photo)
            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
        @endif
        </td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('products.formstock', ['id' => $product->id]) }}"><button class="editar-excluir">Movimentar<i class="fa-regular fa-share-from-square"></i></button></a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
