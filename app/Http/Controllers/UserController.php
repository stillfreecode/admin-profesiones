<?php

namespace App\Http\Controllers; // Define el espacio de nombres, ubicando el archivo dentro de la estructura de controladores.
use Illuminate\Http\Request; // Importa la clase Request para manejar peticiones HTTP, aunque no se use en estos métodos.
use \App\Models\User;
use \App\Models\Profession;

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
        // Profession::create(['title' => 'FullStack-Developer',]);
        $data = request()->validate(
            // 1. Array de reglas 
            [
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => 'required',
            ],
            // 2. Array de mensajes
            [
                'name.required' => 'El campo nombre es obligatorio',
                'password.required' => 'El campo contraseña es obligatorio',
                'email.required' => 'El campo email es obligatorio',
            ]
        );
        //dd($data);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            //'profession_id'=>$data['profession_id'],
        ]);
        return redirect()->route(('users.index'));
    }
    public function update(User $user)
    {
       
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => '', 
        ]);

   
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
       
          
            unset($data['password']);
        }

       
        $user->update($data);

        
        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
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
