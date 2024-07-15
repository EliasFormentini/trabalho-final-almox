@extends("layout")
@section("pageTitle", "Produtos")
@section("content")
<h1>Produtos</h1>
<a href="{{ route('home') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></button></i></a>
<a href="{{ route('products.create') }}"><button class="editar-excluir">Incluir Produto<i class="fa-solid fa-plus"></i></button></a>

<table class="tabela">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Foto</th>
        <th>Descrição</th>
        <th>Marca</th>
        <th>Categoria</th>
        <!-- <th>Estoque</th> -->
        <th>Preço</th>
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
        <td>{{ $product->description }}</td>
        <td>{{ $product->brand ? $product->brand->name : 'Marca não disponível' }}</td>
        <td>{{ $product->category ? $product->category->name : 'Categoria não disponível' }}</td>
        <!-- <td>{{ $product->stock }}</td> -->
        <td>R$ {{ $product->price }}</td>
        <td>
            <a href="{{ route('products.edit', ['id' => $product->id]) }}"><button class="editar-excluir">Editar<i class="fa-solid fa-pen-to-square"></i></button></a>
            <br>
            <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" class="editar-excluir">Excluir<i class="fa-solid fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
