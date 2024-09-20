@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Purchase Order</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('purchaseOrder.index') }}" class="btn btn-primary">Back</a>
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
            <form action="{{ route('purchaseOrder.update', $purchaseOrder->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT') <!-- Add this line to indicate the form is using the PUT method for updates -->

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" 
                                           value="{{ old('date', $purchaseOrder->date) }}">
                                    <span class="text-danger">
                                        @error('date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_id">Company Name</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->id == $purchaseOrder->company_id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_number">PO Number</label>
                                    <input type="text" value="{{ old('po_number', $purchaseOrder->po_number) }}" name="po_number" id="po_number"
                                        class="form-control" placeholder="PO Number">
                                    <span class="text-danger">
                                        @error('po_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from_id">From</label>
                                    <select name="from_id" id="from_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $purchaseOrder->from_id ? 'selected' : '' }}>
                                            {{ $department->dept_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <select name="name" id="name" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($workers as $workers)
                                        <option value="{{ $workers->name }}" {{ $workers->name == $purchaseOrder->name ? 'selected' : '' }}>
                                            {{ $workers->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="for_id">For</label>
                                    <select name="for_id" id="for_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $department->id == $purchaseOrder->for_id ? 'selected' : '' }}>
                                            {{ $department->dept_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="material_type">Material Type</label>
                                    <select name="material_type" id="material_type" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($materialTypes as $materialType)
                                            <option value="{{ $materialType->id }}" {{ $materialType->id == $purchaseOrder->material_type ? 'selected' : '' }}>
                                                {{ $materialType->material_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="material">Material</label>
                                    <select name="material" id="material" class="form-control">
                                        <option value="">--select--</option>
                                        <!-- Populate dynamically if needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity">QTY</label>
                                    <input type="text" value="{{ old('quantity', $purchaseOrder->quantity) }}" name="quantity" id="quantity"
                                        class="form-control" placeholder="Quantity">
                                    <span class="text-danger">
                                        @error('quantity')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="list_po_no">List Po No</label>
                                    <input type="text" value="{{ old('list_po_no', $purchaseOrder->list_po_no) }}" name="list_po_no" id="list_po_no"
                                        class="form-control" placeholder="List Po No">
                                    <span class="text-danger">
                                        @error('list_po_no')
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
            <a href="{{ route('purchaseOrder.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')
<script>
    $(document).ready(function() {
        $('#material_type').change(function() {
            var material_type_id = $(this).val();

            // Clear the material dropdown if no material type is selected
            $('#material').empty().append('<option value="">--select--</option>');

            if (material_type_id) {
                $.ajax({
                    url: '/get-materials/' + material_type_id,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(index, material) {
                            $('#material').append('<option value="' + material.material + '">' + material.material + '</option>');
                        });
                    }
                });
            }
        });

        // Pre-select material options if needed based on existing purchaseOrder data
        var selectedMaterial = "{{ $purchaseOrder->material }}";
        if (selectedMaterial) {
            $('#material').val(selectedMaterial);
        }
    });
</script>
@endsection
