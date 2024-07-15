@extends("layout")
@section("pageTitle", "Movimentos")
@section("content")
    <h1>Movimentação de Estoque</h1>
    <a href="{{ route('products.stock') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>

    <div id="info"> 

    <h1>Produto: </h1>
    <h2> {{ $product->name }}</h2>
    <h1>Estoque: </h1>
    <h2> {{ $product->stock }}</h2>
    @if($product->photo)
            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
    @endif   

    </div>

    <h1>Escolha o tipo de movimentação:</h1>

    <form class="formulario" action="{{ route('products.updateStock', ['id' => $product->id]) }}" method="POST">
    @csrf
    @method('POST')
    <input type="radio" id="entrada" name="movimentacao" value="entrada" checked />
    <label for="entrada">Entrada</label>
    <br>

    <input type="radio" id="saida" name="movimentacao" value="saida" />
    <label for="dewey">Saída</label><br>

    <input type="radio" id="balanco" name="movimentacao" value="balanco" />
    <label for="balanco">Balanço</label>
    <br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" min="1" required>

    <button type="submit">Confirmar</button>
</form>
@endsection