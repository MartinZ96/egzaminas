<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;

class AuthorController extends Controller
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


     
    public function index()
    {
              $authors = Author::orderBy('surname')->get();
       return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
           'name' => ['required', 'min:2', 'max:32', 'alpha'],
           'surname' => ['required', 'min:2', 'max:32','alpha'],
       ],
[
'name.required' => 'Must enter the name',
'name.min' => 'Name too short',
'name.max' => 'Name too long',
'name.alpha' => 'Do not enter numbers or random simbols',

'surname.required' => 'Must enter the surname',
'surname.min' => 'Surname too short',
'surname.max' => 'Surname too long',
'surname.alpha' => 'Do not enter numbers or random simbols',

]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }



$author = new Author;
$author->name = strtolower($request->name);
$author->name = ucfirst($request->name);

$author->surname = strtolower($request->surname);
$author->surname = ucfirst($request->surname);
$author->save();
return redirect()->route('author.index')->with('success_message', 'Success.');
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {

  $validator = Validator::make($request->all(),
       [
           'name' => ['required', 'min:2', 'max:32', 'alpha'],
           'surname' => ['required', 'min:2', 'max:32','alpha'],
       ],
[
'name.required' => 'Must enter the name',
'name.min' => 'Name too short',
'name.max' => 'Name too long',
'name.alpha' => 'Do not enter numbers or random simbols',

'surname.required' => 'Must enter the surname',
'surname.min' => 'Surname too short',
'surname.max' => 'Surname too long',
'surname.alpha' => 'Do not enter numbers or random simbols',

]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

$author->name = strtolower($request->name);
$author->name = ucfirst($request->name);

$author->surname = strtolower($request->surname);
$author->surname = ucfirst($request->surname);
       $author->save();
       return redirect()->route('author.index')->with('success_message', 'Updated.');

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
       if($author->authorBooks->count()){
        return redirect()->route('author.index')->with('info_message', 'Can not be deleted, has books.');
       }
       $author->delete();
       return redirect()->route('author.index')->with('success_message', 'Deleted.');
    }
}
