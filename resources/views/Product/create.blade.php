@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('product.index') }}" class="btn btn-primary">Show All</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            {{-- @if ($errors->all())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $eror)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif --}}
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_code">Code</label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" 
                                           value="{{ old('product_code') }}" placeholder="Code">
                                    <span class="text-danger">
                                        @error('product_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" 
                                           value="{{ old('name') }}" placeholder="Name">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="size">Size</label>
                                    <input type="text" name=size" id=size" class="form-control" 
                                           value="{{ old('size') }}" placeholder="Size">
                                    <span class="text-danger">
                                        @error('size')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" name=price" id=price" class="form-control" 
                                           value="{{ old('price') }}" placeholder="Price">
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <input type="text" name=type" id=type" class="form-control" 
                                           value="{{ old('type') }}" placeholder="Type">
                                    <span class="text-danger">
                                        @error('type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" selected>Active</option>
                                        <option value="Inactive">Inactive</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="" cols="" rows="" class="form-control" placeholder="Description"></textarea>
                                    <span class="text-danger">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="pb-5 pt-3 mx-3">
            <button class="btn btn-primary" name="submit">Create</button>
            <a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')

@endsection
