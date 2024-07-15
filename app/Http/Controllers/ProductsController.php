<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;


class ProductsController extends Controller
{
    public function index () {
        $products = Product::all();

        return view("products", [
            "products" => $products
        ]);

    }

    public function create() {
        $brands = Brand::all();
        $category = Category::all();
        $product = new Product();

        return view("product", [
            "product" => $product,
            "brands" => $brands, 
            "categories" => $category
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "description" => "required",
            // "stock" => "required|numeric",
            "price" => "required|numeric",
            "brand_id" => "required|exists:brands,id",
            "category_id" => "required|exists:categories,id",
            "photo" => "required|image|max:2048"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido.",
            "description.required" => "O campo 'Descrição' deve ser preenchido.",
            // "stock.required" => "O campo 'Estoque' deve ser preenchido.",
            // "stock.numeric" => "O campo 'Estoque' deve ser um numeral.",
            "price.required" => "O campo 'Preço' deve ser preenchido.",
            "price.numeric" => "O campo 'Preço' deve ser um numeral.",
            "brand_id.required" => "O campo 'Marca' deve ser preenchido.",
            "brand_id.exists" => "A marca selecionada não é válida.",
            "category_id.required" => "O campo 'Categoria' deve ser preenchido.",
            "category_id.exists" => "A categoria selecionada não é válida.",
            "photo.required" => "O campo 'Foto' deve ser preenchido.",
            "photo.image" => "O campo 'Foto' deve ser uma imagem.",
            "photo.max" => "O campo 'Foto' deve ter no máximo 2MB.",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $nameFile = uniqid() . "." . $request->file("photo")->extension();
        $request->file("photo")->storeAs("public", $nameFile);

        $product = new Product();
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->photo = $nameFile;
        $product->brand_id = $request->input("brand_id");
        $product->category_id = $request->input("category_id");
        $product->price = $request->input("price");
        // $product->stock = $request->input("stock");
        $product->save();

        return redirect()->route("products.index");
    }

    public function edit($id){
        $product = Product::find($id);
        $brands = Brand::all();  
        $categories = Category::all();

        return view("product", [
            "product" => $product,
            "brands" => $brands, 
            "categories" => $categories
        ]);
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "description" => "required",
            // "stock" => "required|numeric",
            "price" => "required|numeric",
            "brand_id" => "required|exists:brands,id",
            "category_id" => "required|exists:categories,id",
            "photo" => "required|image|max:2048"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido.",
            "description.required" => "O campo 'Descrição' deve ser preenchido.",
            // "stock.required" => "O campo 'Estoque' deve ser preenchido.",
            // "stock.numeric" => "O campo 'Estoque' deve ser um numeral.",
            "price.required" => "O campo 'Preço' deve ser preenchido.",
            "price.numeric" => "O campo 'Preço' deve ser um numeral.",
            "brand_id.required" => "O campo 'Marca' deve ser preenchido.",
            "brand_id.exists" => "A marca selecionada não é válida.",
            "category_id.required" => "O campo 'Categoria' deve ser preenchido.",
            "category_id.exists" => "A categoria selecionada não é válida.",
            "photo.required" => "O campo 'Foto' deve ser preenchido.",
            "photo.image" => "O campo 'Foto' deve ser uma imagem.",
            "photo.max" => "O campo 'Foto' deve ter no máximo 2MB.",
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $product = Product::find($id);
        if (!$product) {
            return back()->withErrors(['error' => 'Produto não encontrado.'])->withInput();
        }

        if($request->hasFile("photo")) {
            $nameFile = uniqid() . "." . $request->file("photo")->extension();
            $request->file("photo")->storeAs("public", $nameFile);
            
            $product->photo = $nameFile;
        }

        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->brand_id = $request->input("brand_id");
        $product->category_id = $request->input("category_id");
        $product->price = $request->input("price");
        // $product->stock = $request->input("stock");
        $product->save();

        return redirect()->route("products.index");
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("products.index");
    }

    public function stock(){
        
        $products = Product::all();
        return view("products_stock", [
            "products" => $products
        ]);
    }


    public function formstock ($id) {

        $product = Product::find($id);

        return view("formstock", [
            "product" => $product
        ]);

    }

    public function updateStock($id, Request $request) {

        $product = Product::find($id);

        $movimentacao = $request->input('movimentacao');
        $quantidade = $request->input('quantidade');

        switch($movimentacao) {
            case 'entrada':
                $product->stock += $quantidade;
            break;

            case 'saida':
                if($product->stock >= $quantidade){
                    $product->stock -= $quantidade;
                } else {
                    return redirect()->route('products.formstock', ['id' => $id])->withErrors(['A quantidade de saída excede o estoque disponível.']);
                }
            break;

            case 'balanco':
                if($quantidade >= 0){
                    $product->stock = $quantidade;
                } else {
                    return redirect()->route('products.formstock', ['id' => $id])->withErrors(['A quantidade não pode ser negativa.']);
                }

            break;
        }

        $product->save();
        return redirect()->route("products.stock");
    }
    
}
 