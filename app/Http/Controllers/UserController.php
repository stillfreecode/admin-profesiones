<?php

namespace App\Http\Controllers; // Define el espacio de nombres, ubicando el archivo dentro de la estructura de controladores.
use Illuminate\Http\Request; // Importa la clase Request para manejar peticiones HTTP, aunque no se use en estos métodos.
use \App\Models\User;

class UserController extends Controller // Define la clase UserController, que hereda funcionalidades del Controller base de Laravel.

{

    public function index()
    {
        $users = User::all();
        $variable = $users;
        $title = 'Usuarios';
        return view('users', compact('variable', 'title'));
    }

    /**
     * El método 'show' se usa para mostrar un recurso específico.
     * Recibe un parámetro ($id) directamente desde la definición de la ruta.
     */
    public function show(User $user)
    {
        // Devuelve una cadena de texto simple con el ID del usuario que se recibió.
        // return "Mostrando el detalle del usuario: {$id}";

        //return view('user-show', compact('id'));
        //$user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function saludo($nombre)
    {
        return view('saludo', compact('nombre'));
    }

    public function store()
    {
        return 'Procesando informacion...';
    }

    public function create()
    {
        return view('users.create');
    }
    /*
     * NOTAS DEL CURSO: OTRAS FORMAS DE PASAR DATOS A LA VISTA
     *
     * Aparte del método mostrado en la función index(), existen otras sintaxis
     * para enviar variables a una vista usando el método with().
     */

    /**
     * Alternativa 1: Usar with() pasando un arreglo asociativo.
     *
     * public function index(){
     * $users=['user1','user2','user3','user4','user5',
     * '<script>alert("Clicker")</script>'];
     * // En la vista, tendríamos las variables $variable y $title
     * return view('users')->with([ 'variable'=> $users, 'title' =>'Usuarios' ]);
     * }
     */

    /**
 * Alternativa 2: Encadenar varios métodos with().
 *
 * public function index(){
 * $users=['user1','user2','user3','user4','user5',
 * '<script>alert("Clicker")</script>'];
 * // Cada with() agrega una variable a la vista.
 * return view('users')->with('variable', $users)->with('title','Usuarios');
 * }
 */
}
