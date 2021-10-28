

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card"style="background-color:#E6E6FA">
               <div class="card-header"style="background-color:#B0E0E6"><b>BOOKS LIST</b></div>
               <div class="card-body">
                    <div class="table-responsive-xl">
                        <table class="table">
                               <form action="{{route('book.index')}}" method="get"> 
                    <fieldset> 
                      <legend style="font-family:Montserrat"><h5>Filter</h5></legend> 
                      <div class="block"> 
                      <div class="form-group"> 
                        <select class="form-control" name="author_id"> 
                          <option value="0" disabled selected>Select Author</option> 
                        @foreach ($authors as $author) 
                            <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option> 
                        @endforeach 
                        </select> 
                                            <div class="block"> 
                      <button type="submit" class="btn btn-info" name="filter" value="author">Filter</button> 
                      <a href="{{route('book.index')}}" class="btn btn-warning">Reset</a> 
                  </div> 
                <tr> 

                         
                    <th scope="col">Name of author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Pages</th>    
                    <th scope="col">ISBN</th>
                    <th scope="col">Short description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
        </div>
                 @foreach ($books as $book)
   @csrf
  </form>
  <tr>
      <td>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</td>
        <td>{{$book->title}}</td>
        <td>{{$book->pages}}</td>
        <td>{{$book->isbn}}</td>
        <td>{!!$book->short_description!!}</td>
  <td><a class="btn btn-warning" href="{{route('book.edit',[$book])}}">EDIT</a></td>
    <td>
     <form method="POST" action="{{route('book.destroy', $book)}}">
         @csrf
         <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
</td>
  <form method="POST" action="{{route('book.destroy', $book)}}">
   @csrf
  </form>
@endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
