<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function showBooks(){
        return response()->json(Book::all());
    }

    public function createBook(Request $request){
        $book = Book::create($request->all());
        return response()->json($book);
    }

    public function updateBook(Request $request){
        $book = Book::findOrFail($request->id);
        $book->update($request->all());
        return response()->json($book);
    }

    public function deleteBook(Request $request){
        Book::findOrFail($request->id)->delete();
        return response('Deleted Successfully', 200);
    }
}
