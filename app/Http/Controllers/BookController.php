<?php

namespace App\Http\Controllers;
use App\Models\Author;

use App\Models\Book;
use Illuminate\Http\Request;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() 

    { 

    $this->middleware('auth'); 

    } 

    public function index(Request $request)
    {
               $books = Book::orderBy('title')->get();
               $authors = Author::orderBy('surname','ASC')->get();
                                     if ($request->filter){
                    $books = Book::where('author_id', $request->author_id)->get();
               }
        return view('book.index', ['books' => $books,'authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                $authors = Author::orderBy('surname')->get();
       return view('book.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   $validator = Validator::make($request->all(),
       [
           'title' => ['required', 'min:1', 'max:100'],
           'pages' => ['required', 'min:1', 'max:100000','numeric'],
           'isbn' => ['required', 'min:13', 'max:100'],

       ],
[
'title.required' => 'Must enter the title',
'title.min' => 'Title too short',
'title.max' => 'Title too long',


'pages.required' => 'Must enter the pages',
'pages.min' => 'Should be atleast a one page',
'pages.max' => 'Too many pages',
'pages.numeric' => 'Must be a number',

'isbn.required' => 'Must enter the ISBN code',
'isbn.min' => 'Should be atleast 13 symbols in ISBN code',
'isbn.max' => 'Too many symbols',
]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
    }
        $book = new Book;
        $book->title = strtolower($request->title);
        $book->title = ucfirst($request->title);
       $book->pages = $request->pages; 
       $book->isbn = $request->isbn;
       $book->short_description = $request->short_description;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Success.');
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
               $authors = Author::orderBy('surname')->get();
       return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

   $validator = Validator::make($request->all(),
       [
           'title' => ['required', 'min:1', 'max:100'],
           'pages' => ['required', 'min:1', 'max:100000','numeric'],
           'isbn' => ['required', 'min:13', 'max:100'],

       ],
[
'title.required' => 'Must enter the title',
'title.min' => 'Title too short',
'title.max' => 'Title too long',


'pages.required' => 'Must enter the pages',
'pages.min' => 'Should be atleast a one page',
'pages.max' => 'Too many pages',
'pages.numeric' => 'Must be a number',

'isbn.required' => 'Must enter the ISBN code',
'isbn.min' => 'Should be atleast 13 symbols in ISBN code',
'isbn.max' => 'Too many symbols',
]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
    }
        $book->title = $request->title;
       $book->isbn = $request->isbn;
       $book->pages = $request->pages;
       $book->short_description = $request->short_description;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
               $book->delete();
       return redirect()->route('book.index')->with('success_message', 'Deleted.');
    }
}
