<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuarios(): void
    {
        $response = $this->get('/usuarios');
        $response->assertStatus(200);
        $response->assertSee('usuarios');
    }

    /** @test */
    public function test_usuarios_empty(): void
    {
        // Sin usuarios creados, debería mostrar el mensaje de vacío
        $response = $this->get('/usuarios');

        $response->assertStatus(200);
        $response->assertSee('No hay usuarios registrados');
    }

    /** @test */
    public function test_it_shows_the_users_list(): void
    {
        // Crear una profesión
        $profession = Profession::create(['title' => 'Backend Developer']);
        // Crear usuarios asociados a esa profesión
        $user1 = User::factory()->create([
            'name' => 'user7',
            'profession_id' => $profession->id,
        ]);
        $user2 = User::factory()->create([
            'name' => 'user8',
            'profession_id' => $profession->id,
        ]);
        // Hacer la petición
        $response = $this->get('/usuarios');
        // Validar que la vista cargue correctamente
        $response->assertStatus(200);

        // Verificar que el contenido muestre los usuarios creados
        $response->assertSee('user7');
        $response->assertSee('user8');
    }

    function test_it_displays_the_users_details(): void
    {
        $this->withoutExceptionHandling();
        $profession = Profession::create(['title' => 'frontEnd-developer',]);
        $user = User::factory()->create(['name' => 'Usuario 100', 'profession_id' => $profession->id,]);
        //dd($user);
        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee('Usuario 100');
    }


    function test_it_displays_a_404_error_if_the_user_is_not_found(): void
    {
        $this->get('usuarios/999')
            ->assertStatus(404)
            ->assertSee('Pagina no encontrada');
    }

    function test_it_load_the_new_users_page(): void
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

    function test_it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();
        $this->post('/usuarios/', [
            'name' => 'usuario20',
            'email' => 'usuario20@mail.com',
            'password' => '12345',
            //'profession_id' => '3',
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'usuario20',
            'email' => 'usuario20@mail.com',
            'password' => '12345'
        ]);
    }

    function test_the_name_is_required()
    {
        $this->withExceptionHandling();
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'user21@mail.com',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'user21@mail.com',
        ]);
    }
    function test_the_email_is_required()
    {
        $this->withExceptionHandling();
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'NewUser',
                'email' => '',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }

    function test_the_email_must_be_valid()
    {
        $this->withExceptionHandling();
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'UserNew2',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }

    function test_the_email_must_be_unique()
    {
        User::factory()->create([
            'name' => 'user300',
            'email' => 'user30000@mail.com',
            'profession_id' => null,
        ]);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'UserNew3',
                'email' => 'user30000@mail.com',
                'password' => '123456'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1, User::count());
    }

    function test_the_password_is_required()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Sultano',
                'email' => 'Sultano@gmail.com',
                'password' => ''
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);
        $this->assertEquals(0, User::count());
    }

    function test_it_loads_the_edit_user_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'name' => 'user300',
            'email' => 'user30000@mail.com',
            'profession_id' => null,
        ]);
        $this->get("/usuarios/{$user->id}/editar") // usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });
    }

    function test_it_updates_a_user()
    {
        //Crear un usuario inicial (Datos viejos)
        $user = \App\Models\User::factory()->create([
            'name' => 'Nombre Viejo',
            'email' => 'viejo@mail.com',
            'profession_id' => null,
        ]);

        //Enviar petición PUT a la ruta de actualización con DATOS NUEVOS
        $this->put("/usuarios/{$user->id}", [
            'name' => 'Nombre Nuevo',
            'email' => 'nuevo@mail.com',
            'password' => '12345678'
        ])
            ->assertRedirect("/usuarios/{$user->id}"); // Esperamos que redirija al detalle

        //Verificar que en la base de datos el nombre cambió
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@mail.com',
            'name' => 'Nombre Nuevo' // Verificamos que se guardó el cambio
        ]);

        //Verificar que los datos viejos YA NO existen
        $this->assertDatabaseMissing('users', [
            'email' => 'viejo@mail.com',
        ]);
    }

    function test_it_deletes_a_user()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'user2048@mail.com',
            'profession_id' => null
        ]);

        $this->delete("/usuarios/{$user->id}")
            ->assertRedirect('usuarios');
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }

    function test_the_password_is_optional_when_updating_the_user()
{
    // Crear usuario con contraseña conocida
    $user = User::factory()->create([
        'name' => 'Original',
        'email' => 'original@mail.com',
        'password' => bcrypt('mi-pass'),
        'profession_id' => null,
    ]);

    // Guardamos la contraseña encriptada para compararla después
    $oldPassword = $user->password;

    // Enviar actualización SIN contraseña
    $this->put("/usuarios/{$user->id}", [
        'name' => 'Nuevo Nombre',
        'email' => 'nuevo@mail.com',
        'password' => ''   
    ])
    ->assertRedirect("/usuarios/{$user->id}");

    // Refrescamos datos desde DB
    $user->refresh();

    // Verificar que SÍ cambió el nombre
    $this->assertEquals('Nuevo Nombre', $user->name);
    $this->assertEquals('nuevo@mail.com', $user->email);

    // Verificar que la contraseña SIGUE siendo la misma
    $this->assertEquals($oldPassword, $user->password);
}

public function test_the_email_must_be_unique_when_updating_a_user()
{
    // Usuario existente en la base
    $existingUser = User::factory()->create([
        'email' => 'registrado@mail.com',
        'profession_id' => null,
    ]);

    // Usuario que intentará usar el mismo correo al actualizar
    $userToUpdate = User::factory()->create([
        'email' => 'original@mail.com',
        'profession_id' => null,
    ]);

    // Intentar actualizar con el email ya registrado
    $this->from("/usuarios/{$userToUpdate->id}/editar")
        ->put("/usuarios/{$userToUpdate->id}", [
            'name' => 'Usuario Cambiado',
            'email' => 'registrado@mail.com', 
            'password' => ''
        ])
        ->assertRedirect("/usuarios/{$userToUpdate->id}/editar")
        ->assertSessionHasErrors(['email']);

    // Asegura que el usuario no fue actualizado
    $this->assertDatabaseHas('users', [
        'id' => $userToUpdate->id,
        'email' => 'original@mail.com',
    ]);
}

function test_the_password_is_required_when_updating_the_user()
{
    $user = User::factory()->create([
        'profession_id' => null,
    ]);

    $this -> from("usuarios/{$user->id}/editar")
        -> put("/usuarios/{$user->id}", [
            'name' => 'NewUser900',
            'email' => 'NewUser900@mail.com',
            'password' => ''
        ])
        -> assertRedirect("usuarios/{$user->id}/editar")
        -> assertSessionHasErrors(['password']);

         $this->assertDatabaseMissing('users', [
            'email' =>  'NewUser900@gmail.com'     ]);
}

   function test_the_users_email_can_stay_the_same_when_updating_the_user(){
    $user = User::factory()->create([
        'name'=>'user1024',
        'email'=>'user1024@mail.com',
        'profession_id'=>null,
    ]);

    $this->from("usuarios/{$user->id}/editar")
    ->put("/usuarios/{$user->id}",[
    'name'=>'NewUser1024',
    'email'=>'user1024@mail.com',
    'password'=>'12345678',
    ]
    )

    ->assertRedirect("usuarios/{$user->id}",);
    $this->assertDatabaseMissing('users',
    ['name'=>'user1024', ]);
   }
}
