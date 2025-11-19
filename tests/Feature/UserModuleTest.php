<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profession;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_probar_ruta_uno(): void
    {
        $response = $this->get('/ruta1');

        $response->assertStatus(200);
        $response->assertSee('Cadena de la ruta 1');
    }

    /** @test */
    /* public function test_details_page(): void
    {
        $response = $this->get('/usuarios/10');

        $response->assertStatus(200);
        $response->assertSee('Mostrando detalle del usuario: 10');
    }*/

    /** @test */
    public function test_new_users_page(): void
    {
        $response = $this->get('/usuarios/nuevo');

        $response->assertStatus(200);
        $response->assertSee('Creando un usuario nuevo');
    }

    /** @test */
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
}
