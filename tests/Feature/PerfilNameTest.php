<?php

namespace Tests\Feature; // Espacio de nombres para las pruebas de tipo "Feature".

use Illuminate\Foundation\Testing\RefreshDatabase; // Traits para interactuar con la base de datos (no usado en este test).
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; // Clase base para todas las pruebas de la aplicación.

class PerfilNameTest extends TestCase
{
 
    /**
     * Prueba la ruta del perfil con un nombre específico.
     * Los nombres de los métodos de prueba deben comenzar con "test_".
     *
     * @return void
     */
    // public function test_perfil_name2():void{
    //     // 1. Simula una petición GET a la URL 'perfil/Angel'.
    //     // Laravel ejecuta la ruta correspondiente y captura la respuesta.
    //     $response=$this->get('perfil/Angel');

    //     // 2. Verifica (assert) que la respuesta HTTP tenga un código de estado 200 (OK).
    //     // Esto confirma que la página se cargó correctamente.
    //     $response->assertStatus(200);

    //     // 3. Verifica que el contenido de la respuesta contenga el texto exacto "Mostrando el perfil de: Angel".
    //     // Esto confirma que la lógica de la ruta funciona como se espera.
    //     $response->assertSee("Mostrando el perfil de: Angel");
    // }

 
}