<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return "hola desde la pagina de inicio";
    }

    // cuando definimos un metodo invoke no hara falta asignarle una función en urls
    public function __invoke()
    {
        return view('welcome');
    }
}
