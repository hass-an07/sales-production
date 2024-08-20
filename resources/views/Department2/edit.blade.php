@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Department 2</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('department2.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('department2.update', $departmentTwo->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage') <!-- Ensure this partial shows messages correctly -->
                        
                        <!-- Hidden input for created_by (if needed) -->
                        {{-- <input type="hidden" name="created_by" value="{{ Auth::user()->id }}"> --}}
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dept_name">Department Name</label>
                                <input type="text" value="{{ $departmentTwo->dept_name }}" 
                                       name="dept_name" id="dept_name" class="form-control" placeholder="Department Name">
                                <span class="text-danger">
                                    @error('dept_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                <a href="{{ route('department2.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customjs')
<!-- Custom JS if needed -->
@endsection
