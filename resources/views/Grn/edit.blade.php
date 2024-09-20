@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit GRN</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('grn.index') }}" class="btn btn-primary">Back</a>
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
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif --}}
            <form action="{{ route('grn.update', $grn->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_id">Company</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ $grn->company_id == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('company_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_date">P.O Date</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control" 
                                           value="{{ old('po_date', $grn->po_date) }}">
                                    <span class="text-danger">
                                        @error('po_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_order_no">P.Order No</label>
                                    <input type="text" name="po_order_no" id="po_order_no" class="form-control" 
                                           value="{{ old('po_order_no', $grn->po_order_no) }}" placeholder="P.Order NO">
                                    <span class="text-danger">
                                        @error('po_order_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="grn_no">GRN No</label>
                                    <input type="text" name="grn_no" id="grn_no" class="form-control" 
                                           value="{{ old('grn_no', $grn->grn_no) }}" placeholder="GRN NO">
                                    <span class="text-danger">
                                        @error('grn_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="invoice_no">Invoice Number</label>
                                    <input type="text" name="invoice_no" id="invoice_no" class="form-control" 
                                           value="{{ old('invoice_no', $grn->invoice_no) }}" readonly>
                                    <span class="text-danger">
                                        @error('invoice_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="grn_date">G.R.N Date</label>
                                    <input type="date" name="grn_date" value="{{ old('grn_date', $grn->grn_date) }}" id="grn_date" class="form-control">
                                    <span class="text-danger">
                                        @error('grn_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="supplier_id">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $grn->supplier_id == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('supplier_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lo_pono">List of P.O No</label>
                                    <input type="text" name="lo_pono" id="lo_pono" class="form-control" 
                                           value="{{ old('lo_pono', $grn->lo_pono) }}">
                                    <span class="text-danger">
                                        @error('lo_pono')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="number" name="total_amount" id="total_amount" class="form-control" 
                                           value="{{ old('total_amount', $grn->total_amount) }}">
                                    <span class="text-danger">
                                        @error('total_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('grn.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')

@endsection
