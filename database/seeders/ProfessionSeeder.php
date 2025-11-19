<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * []
     */
    public function run(): void
    {
        /**Constructor de consultas en Laravel
         * Inyeccion SQL y seguridad
         * EJEMPLO INSEGURO -> DB::insert('INSERT INTO professions (title) VALUES ("backEnd-developer")');
         * EJEMPLO SEGURO USANDO PROTECCIONES EN SQL -> DB::insert('INSERT INTO professions (title) VALUES (?)', ['backEnd-developer']); 
         * PARAMETRO DE SUSTITUCIÒN CON NOMBRE -> DB::insert('INSERT INTO professions (title) VALUES (?)' ("backEnd-developer")');
         */
        
        Profession::create(['title'=>'backEnd-developer']);
        Profession::create(['title'=>'frontEnd-developer']);
        Profession::create(['title'=>'FullStack-developer']);
        Profession::create(['title'=>'Project-Manager']);

        Profession::factory()->count(10)->create();
    }
}
