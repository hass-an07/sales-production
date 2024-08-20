@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>update Department</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('department.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        
        <form action="{{ route('materialType.update',$materialType->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage')
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="material_type">Department Name</label>
                                <input type="text" value="{{ $materialType->material_type }}" name="material_type"
                                    id="material_type" class="form-control" placeholder="Department Name">
                                <span class="text-danger">
                                    @error('material_type')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary" name="submit">update</button>
                <a href="{{route('department.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customjs')

@endsection