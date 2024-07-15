<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

class BrandsController extends Controller
{
    public function index () {
        $brands = Brand::all();

        return view("brands", [
            "brands" => $brands
        ]);

    }

    public function create() {
        $brand = new Brand();

        return view("brand", [
            "brand" => $brand
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido"
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $nameFile = uniqid() . "." . $request->file("logomarca")->extension();
        $request->file("logomarca")->storeAs("public", $nameFile);

        $brand = new Brand();
        $brand->name = $request->input("name");
        $brand->photo = $nameFile;
        $brand->save();

        return redirect()->route("brands.index");
    }

    public function edit($id){
        $brand = Brand::find($id);

        return view("brand", [
            "brand" => $brand
        ]);
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ],[
            "name.required" => "O campo 'Nome' deve ser preenchido"
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $brand = Brand::find($id);

        if($request->hasFile("logomarca")) {
            $nameFile = uniqid() . "." . $request->file("logomarca")->extension();
            $request->file("logomarca")->storeAs("public", $nameFile);
            
            $brand->photo = $nameFile;
        }

        $brand->name = $request->input("name");
        $brand->save();

        return redirect()->route("brands.index");
    }

    public function destroy($id) {
        $brand = Brand::find($id);

        if($brand->products()->count() > 0){
            return redirect()->route("brands.index")->withErrors('Não é possível excluir a marca porque ela está sendo usada em um produto.');
        }
        $brand->delete();

        return redirect()->route("brands.index");
    }
}
 