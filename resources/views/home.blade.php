@extends("layout")
@section("pageTitle", "Almoxarifado.")
@section("content")
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Almoxarifado</title>
</head>
<body>

    <div id=container>

    <h1>Sistema de almoxarifado</h1>
        <div id="grid">

            <div class="item">
            <h2>Marcas</h2>
            <a href="{{ route('brands.index') }}">
                <button>
                Acessar 
                <i class="fa-solid fa-arrow-right"></i>
                </button>
            </a>
            </div>

            <div class="item">
            <h2>Categorias</h2>
            <a href="{{ route('categories.index') }}"></i><button >Acessar <i class="fa-solid fa-arrow-right"></i></button></a>
            </div>

            <div class="item">
            <h2>Produtos</h2>
            <a href="{{ route('products.index') }}"><button>Acessar <i class="fa-solid fa-arrow-right"></i></button></a>
            </div>

            <div class="item">
            <h2>Estoque</h2>
            <a href="{{ route('products.stock') }}"><button>Acessar <i class="fa-solid fa-arrow-right"></i></button></a>
            </div>
        </div>
    </div>

</body>
</html>
@endsection