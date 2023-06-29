<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = storage_path() . "/app/json/books1.json";
        $book_shelfs = json_decode(file_get_contents($path), true);

        foreach ($book_shelfs as $value) {
            Books::create([
                "title" => $value['title'],
                "author" => $value['author'],
                "publisher" => $value['publisher'],
                "publication_date" => $value['publication_date'],
                "isbn" => $value['isbn'],
                "price" => $value['price'],
                // to store array from json file --- somewhat like "genre":["Historical", "Drama"],
                "genre" => json_encode($value['genre']),
                "summary" => $value['summary'],
                "quantity" => $value['quantity']
            ]);
        }
    }
}
