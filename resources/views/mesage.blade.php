@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session::get('error') }}
  </div>
@endif

@if(session::get('success'))
    
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session::get('success')}}
  </div>
@endif  
