@extends("layout")
@section("pageTitle", "Novo produto")
@section("content")
    <h1>Novo Produto</h1>
    <a href="{{ route('products.index') }}"><button class="editar-excluir">Voltar<i class="fa-solid fa-circle-left"></i></button></a>
    @if($product->id)
    <form action="{{ route('products.update', ['id' => $product->id]) }}" class="formulario" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @else
    <form action="{{ route('products.store') }}" class="formulario" method="POST" enctype="multipart/form-data">
    @endif
        @csrf
        <label for="name">Nome:</label>
        <br>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <label for="photo">Foto:</label>
        <br>
        <input type="file" name="photo" id="photo">
        @error('photo')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <label for="description">Descrição:</label>
        <br>
        <input type="text" name="description" id="description" value="{{ old('description', $product->description) }}">
        @error('description')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <label for="brand_id">Marca:</label>
        <br>
        <select name="brand_id" id="brand_id">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                {{ $brand->id == old('brand_id', $product->brand_id) ? 'selected' : '' }}
                >         
                {{ $brand->name }}
                </option>
            @endforeach
        </select>
        @error('brand_id')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <label for="category_id">Categoria:</label>
        <br>
        <select name="category_id" id="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}
                >         
                {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <!-- <label for="stock">Estoque:</label>
        <br>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"> -->
        @error('stock')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <label for="price">Preço:</label>
        <br>
        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}">
        @error('price')
            <div>{{ $message }}</div>
        @enderror
        <br>
        <button type="submit">Salvar</button>
    </form>
@endsection
