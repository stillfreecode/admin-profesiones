<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeProductController extends Controller
{
    public function index ($sku,$nombre=null){
        if($nombre){
            return "SKU: {$sku}, Nombre: {$nombre}";
        }else{
             return "SKU: {$sku}, producto sin nombre";
        }
    }

    public function products(){
        if(request()->has('empty')){
        $productos = []; }
        else {
            $productos=['samsung-galaxy20-128gb', 'xiaomi-redmi10-64gb', 'apple-iphone14-256gb',
            'lenovo-deapad3-8gb', 'asus-vivobook15-512gb'];
        }
        $variable = $productos;
        $title = 'Listado de Productos';
        return view('products-show', compact('variable', 'title'));
    }
    
}


