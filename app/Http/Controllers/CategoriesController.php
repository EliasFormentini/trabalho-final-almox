<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index () {
        $categories = Category::all();

        return view("categories", [
            "categories" => $categories
        ]);

    }

    public function create() {
        $categorie = new Category();

        return view("categorie", [
            "categorie" => $categorie
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "description" => "required|min:10"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido",
            "description.required" => "O campo 'Descrição' deve ser preenchido",
            "description.min" => "O campo 'Descrição' deve ter no mínimo 10 caracteres"
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $categorie = new Category();
        $categorie->name = $request->input("name");
        $categorie->description = $request->input("description");
        $categorie->save();

        return redirect()->route("categories.index");
    }

    public function edit($id){
        $categorie = Category::find($id);

        return view("categorie", [
            "categorie" => $categorie
        ]);
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "description" => "required|min:10"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido",
            "description.required" => "O campo 'Descrição' deve ser preenchido",
            "description.min" => "O campo 'Descrição' deve ter no mínimo 10 caracteres"
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $categorie = Category::find($id);

        $categorie->name = $request->input("name");
        $categorie->description = $request->input("description");
        $categorie->save();

        return redirect()->route("categories.index");
    }

    public function destroy($id) {
        $category = Category::find($id);

        if($category->products()->count() > 0){
            return redirect()->route("categories.index")->withErrors('Não é possível excluir a categoria porque ela está sendo usada em um produto.');
        }

        $category->delete();

        return redirect()->route("categories.index");
    }
}
 