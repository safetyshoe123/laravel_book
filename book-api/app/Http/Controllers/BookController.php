<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::latest()->paginate(10);
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $book = new Books();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_date = $request->publication_date;
        $book->isbn = $request->isbn;
        $book->price = $request->price;
        $book->genre = $request->genre;
        $book->summary = $request->summary;
        $book->quantity = $request->quantity;

        $book->save();
        return response()->json("Posting book is successful");
        // return view('book_shelf.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_date' => 'required',
            'isbn' => 'required',
            'price' => 'required',
            'genre' => 'required',
            'summary' => 'required',
            'quantity' => 'required'
        ]);
        Books::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books_id = Books::find($id);
        return response()->json($books_id);
    }

    /**
     * Display the specified genre of books
     * **/

     public function showGenre(Request $request, string $genre){
        
        $genre = Books::query();
        if(request('genre')){
            $genre->where('genre', 'LIKE', '%' . request('genre') . '%');
        }
        return $genre->orderBy('id', 'ASC')->paginate(10);

     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_date' => 'required',
            'isbn' => 'required',
            'price' => 'required',
            'genre' => 'required',
            'summary' => 'required',
            'quantity' => 'required'

        ]);

        $book->update($request->all());
        return response()->json('Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::find($id)->delete();
        return response()->json('Books successfully Deleted');
    }
}
