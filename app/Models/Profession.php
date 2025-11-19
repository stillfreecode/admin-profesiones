<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//$objeto = Profession::all();
//$objeto -> Profession::first();
//$objeto -> Profession::last();
//$objeto -> Profession::random(1);
//$objeto -> Profession::random();
//$objeto -> Profession::pluck('title');
/**
 * Buscar en consola tinker
 * $result = Profession::where('title','frontEnd-developer')->first();
 * $user = User:: find(1);
 */


class Profession extends Model
{
    use HasFactory;
    //protected $table = 'nombre_tabla';
    protected $fillable = ['title'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
