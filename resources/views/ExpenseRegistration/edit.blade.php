@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Expense Registration</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('registerExpense.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('registerExpense.update',$expenseregistration->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ex_code">Expense Code</label>
                                    <input type="text" name="ex_code" id="ex_code" class="form-control" 
                                           value="{{ old('ex_code', $expenseregistration->ex_code) }}" placeholder="Code">
                                    <span class="text-danger">
                                        @error('ex_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ex_name">Expense Name</label>
                                    <input type="text" name="ex_name" id="ex_name" class="form-control" 
                                           value="{{ old('ex_name', $expenseregistration->ex_name) }}" placeholder="Name">
                                    <span class="text-danger">
                                        @error('ex_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="active" {{ $expenseregistration->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ $expenseregistration->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
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
            <button class="btn btn-primary" name="submit">Update</button>
            <a href="{{ route('registerExpense.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')

@endsection
