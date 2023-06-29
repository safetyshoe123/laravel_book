<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'book_shelf';

    // protected $primaryKey = 'id';
 
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_date',
        'isbn',
        'price',
        'genre',
        'summary',
        'quantity'
    ];

    protected $casts = [
        'genre' => 'array'
    ];

    public function toSearchableGenre(){
        $data -> $this->toArray();

        $data['genre'] = explode(';', $data['genre']);

        return $data;
    }
}