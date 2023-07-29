<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Desactivamos los eventos del modelo para una inserción más rápida
        Book::withoutEvents(function () {
            // Obtenemos todos los libros existentes
            $books = Book::all();

            // Obtenemos todos los autores existentes
            $authors = Author::all();

            // Asociamos autores aleatoriamente a los libros
            $books->each(function ($book) use ($authors) {
                // Seleccionamos un autor aleatorio
                $author = $authors->random();

                // Asociamos el autor al libro
                $book->authors()->attach($author->id);
            });
        });
    }
}