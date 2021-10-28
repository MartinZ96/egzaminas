
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"style="background-color:#FAD5A5"><b>NEW AUTHOR</b></div>

               <div class="card-body">
                 <form method="POST" action="{{route('author.store')}}">
     <div class="form-group">
  <label>Name</label>
  <input type="text" name="name"  class="form-control">
  <small class="form-text text-muted">Author name.</small>
  </div>
    <div class="form-group">
  <label>Surname</label>
  <input type="text" name="surname"  class="form-control">
  <small class="form-text text-muted">Author surname.</small>
  </div>
   @csrf
   <button type="submit"class="btn btn-primary">CREATE</button>
</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
