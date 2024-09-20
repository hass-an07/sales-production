@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>update Weight Type</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('weightType.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        
        <form action="{{ route('weightType.update',$weightType->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage')
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="weight_type">Weight Type</label>
                                <input type="text" value="{{ $weightType->weight_type }}" name="weight_type"
                                    id="weight_type" class="form-control" placeholder="Weight Type Name">
                                <span class="text-danger">
                                    @error('weight_type')
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
                <a href="{{route('weightType.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customjs')

@endsection