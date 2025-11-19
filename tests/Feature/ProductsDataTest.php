<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsDataTest extends TestCase
{
    /**
     * Prueba la ruta de productos cuando se proporcionan todos los parámetros (sku y nombre).
     */
    public function test_products_with_name():void{
        // 1. Simula una petición GET a la ruta 'productos' con dos parámetros.
        $response=$this->get('productos/hp-345-128GB/USB');

        // 2. Verifica que la respuesta HTTP sea 200 (OK).
        $response->assertStatus(200);

        // 3. Verifica que el contenido de la respuesta muestre tanto el SKU como el Nombre.
        $response->assertSee('SKU: hp-345-128GB, Nombre: USB');
    }

    /**
     * Prueba la ruta de productos cuando solo se proporciona el parámetro obligatorio (sku),
     * omitiendo el parámetro opcional (nombre).
     */
    public function test_products_without_name():void{
        // 1. Simula una petición GET a la ruta 'productos' con solo un parámetro.
        $response=$this->get('productos/hp-345-128GB');

        // 2. Verifica que la respuesta HTTP sea 200 (OK).
        $response->assertStatus(200);

        // 3. Verifica que la respuesta muestre el SKU y el texto por defecto para un producto sin nombre.
        $response->assertSee('SKU: hp-345-128GB, producto sin nombre');
    }
    
    /**
     * NOTA: Este es el test de ejemplo que Laravel incluye por defecto.
     * Sirve para verificar que la página de inicio ('/') carga correctamente.
     *
     * public function test_example(): void
     * {
     * $response = $this->get('/');
     * $response->assertStatus(200);
     * }
     */

}