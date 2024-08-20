@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>update Company</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('company.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        
        <form action="{{ route('company.update',$company->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage')
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_name">Company Name</label>
                                <input type="text" value="{{ $company->company_name }}" name="company_name"
                                    id="company_name" class="form-control" placeholder="Company Name">
                                <span class="text-danger">
                                    @error('company_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" value="{{ $company->owner_name }}" name="owner_name" id="owner_name"
                                    class="form-control" placeholder="first name">
                                <span class="text-danger">
                                    @error('owner_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" value="{{ $company->address }}" name="address" id="address"
                                    class="form-control" placeholder="Address">
                                <span class="text-danger">
                                    @error('address')
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
                <a href="{{route('company.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customjs')

@endsection