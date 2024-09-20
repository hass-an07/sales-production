@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                {{-- <div class="col-sm-6 text-right">
                    <a href="{{ route('account.register') }}" class="btn btn-primary">Add User</a>
                </div> --}}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">

            <div class="card">
                {{-- <form action="{{ route('storeRole') }}" method="POST">
                    <div class="card-header">
                        @include('mesage')
                    </div>
                </form> --}}
                <div class="card-body table-responsive p-0">
                    <form action="{{ route('storeRole') }}" method="POST">
                        @csrf
                    <div class="col-4 mb-3">
                        <label for="">Role</label>
                        <input type="text" name="role" id="" class="form-control" placeholder="Enter Role">    
                    </div>   
                    <div class="col-12">
                        @foreach ($modules as $module)
                         <div class="d-flex align-items-center">
                            <input type="checkbox" name="modules[]" value="{{$module->id}}" id="" class="mx-2">  <h5>{{ $module->module }}</h1>
                         </div>
                        @endforeach
                    </div>
                    <button class="btn btn-primary m-4">Save</button>
                    </form>
                </div>
                <div class="card-footer clearfix">
                    {{-- {{ $products->links('pagination::bootstrap-5') }} --}}

                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>

@endsection

@section('customjs')
    <script>
        console.log('hello');
    </script>
@endsection
