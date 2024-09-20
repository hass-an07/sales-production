@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Recived Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('recivedproduct.index') }}" class="btn btn-primary">View</a>
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
            <form action="{{ route('recivedproduct.store') }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" 
                                           value="{{ old('date') }}" placeholder="Date">
                                    <span class="text-danger">
                                        @error('date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dept_id">Departments</label>
                                    <select name="dept_id" id="" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('dept_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reciver_name">Reciver Name</label>
                                    <input type="text" name="reciver_name" id=reciver_name" class="form-control" 
                                           value="{{ old('reciver_name') }}" placeholder="Reciver Name">
                                    <span class="text-danger">
                                        @error('reciver_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                           
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_code">Product Code</label>
                                    <input type="text" name="product_code" id=product_code" class="form-control" 
                                           value="{{ old('product_code') }}" placeholder="Product Code">
                                    <span class="text-danger">
                                        @error('product_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id=product_name" class="form-control" 
                                           value="{{ old('product_name') }}" placeholder="Product Name">
                                    <span class="text-danger">
                                        @error('product_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" name="product_price" id="" class="form-control" placeholder="Product Price">
                                    <span class="text-danger">
                                        @error('product_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product_qty">Product Qty</label>
                                    <input type="number" name="product_qty" id="" class="form-control" placeholder="Product Qty">
                                    <span class="text-danger">
                                        @error('product_qty')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="net_amount">Net Amount</label>
                                    <input type="number" name="net_amount" id="" class="form-control" placeholder="Net Amount">
                                    <span class="text-danger">
                                        @error('net_amount')
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
            <a href="{{ route('recivedproduct.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')

@endsection
