

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"style="background-color:#87CEEB"><b>BOOK TITLE</b></div>

               <div class="card-body">
                 <form method="POST" action="{{route('book.update',[$book])}}">
            <div class="form-group">
  <label>Title</label>
  <input type="text" name="title"  class="form-control"value="{{$book->title}}">
  <small class="form-text text-muted">Book title.</small>
  </div>
            <div class="form-group">
  <label>Pages</label>
  <input type="text" name="pages"  class="form-control"value="{{$book->pages}}">
  <small class="form-text text-muted">Number of pages.</small>
  </div>
           <div class="form-group">
  <label>ISBN</label>
  <input type="text" name="isbn"  class="form-control"value="{{$book->isbn}}">
  <small class="form-text text-muted">ISBN code.</small>
  </div>
       Short description: <textarea name="short_description"id="summernote">{!!$book->short_description!!}</textarea>
       <select name="author_id">
           @foreach ($authors as $author)
               <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                   {{$author->name}} {{$author->surname}}
               </option>
           @endforeach
</select>
       @csrf
       <br><br>
       <button type="submit" class="btn btn-primary">UPDATE</button>
</form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>
@endsection
