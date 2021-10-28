

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card"style="background-color:#E6E6FA">
               <div class="card-header"style="background-color:#B0E0E6"><b>AUTHORS LIST</b></div>
               <div class="card-body">
                    <div class="table-responsive-xl">
                        <table class="table">
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>    
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
        </div>
                 @foreach ($authors as $author)
                 <tr>
        <td>{{$author->name}}</td>
        <td>{{$author->surname}}</td>
  <td><a class="btn btn-warning" href="{{route('author.edit',[$author])}}">EDIT</a></td>
    <td>
     <form method="POST" action="{{route('author.destroy', $author)}}">
         @csrf
         <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
</td>
  <form method="POST" action="{{route('author.destroy', $author)}}">
   @csrf
  </form>
@endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
