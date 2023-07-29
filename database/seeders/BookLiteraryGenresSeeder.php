<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookLiteraryGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definimos los géneros literarios para libros
        $literaryGenres = [
            ['name' => 'Ficción'],
            ['name' => 'Novela'],
            ['name' => 'Ciencia ficción'],
            ['name' => 'Misterio'],
            ['name' => 'Terror'],
            ['name' => 'Fantasía'],
            ['name' => 'Aventura'],
            ['name' => 'Romance'],
            ['name' => 'Drama'],
            ['name' => 'Poesía'],
            // Puedes agregar más géneros literarios aquí
        ];

        // Insertamos los géneros literarios en la tabla correspondiente
        DB::table('book_literary_genres')->insert($literaryGenres);
    }
}