@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Requisition</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('worker.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('requisition.update', $requisition->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ $requisition->created_by }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" value="{{ $requisition->date }}" name="date" id="worker_code"
                                        class="form-control" placeholder="Code">
                                    <span class="text-danger">
                                        @error('date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="time">Time</label>
                                    <input type="time" value="{{ $requisition->time }}" name="time" id="time"
                                        class="form-control" placeholder="Code">
                                    <span class="text-danger">
                                        @error('time')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_id">Company</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}" {{ $requisition->company_id == $company->id ? 'selected' : '' }}>
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
                                    <label for="requisition">Requisition</label>
                                    <input type="text" value="{{ $requisition->requisition }}" name="requisition" id="requisition"
                                        class="form-control" placeholder="Requisition">
                                    <span class="text-danger">
                                        @error('requisition')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="returnable" {{ $requisition->status == 'returnable' ? 'selected' : '' }}>Returnable</option>
                                        <option value="consumable" {{ $requisition->status == 'consumable' ? 'selected' : '' }}>Consumable</option>
                                        <option value="process" {{ $requisition->status == 'process' ? 'selected' : '' }}>Process</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="store">Store</label>
                                    <select name="store" id="" class="form-control">
                                        <option value="main_store" {{ $requisition->store == 'main_store' ? 'selected' : '' }}>Main Store</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('store')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dept_id">Department</label>
                                    <select name="dept_id" id="" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $requisition->dept_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->dept_name }}
                                            </option>
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
                                    <label for="reciver">Reciver</label>
                                    <input type="text" value="{{ $requisition->receiver }}" name="reciver" id="reciver"
                                        class="form-control" placeholder="Reciver">
                                    <span class="text-danger">
                                        @error('reciver')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="material_ty_id">Material Type</label>
                                    <select name="material_ty_id" id="material_type" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($mateialTypes as $mateialType)
                                            <option value="{{ $mateialType->id }}" {{ $requisition->material_ty_id == $mateialType->id ? 'selected' : '' }}>
                                                {{ $mateialType->material_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('material_ty_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="material_id">Material </label>
                                    <select name="material" id="material" class="form-control">
                                        {{-- <option value="">--select--</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}">
                                                {{ $material->material }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger">
                                        @error('material_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="qty">Qty</label>
                                    <input type="number" value="{{ $requisition->qty }}" name="qty" id="qty"
                                        class="form-control" placeholder="Qty">
                                    <span class="text-danger">
                                        @error('qty')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" value="{{ $requisition->price }}" name="price" id="price"
                                        class="form-control" placeholder="Price">
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="total">Total</label>
                                    <input type="number" value="{{ $requisition->total }}" name="total" id="total"
                                        class="form-control" placeholder="Total">
                                    <span class="text-danger">
                                        @error('total')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="issue_for_id">Issue For</label>
                                    <select name="issue_for_id" id="" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $requisition->issue_for_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('issue_for_id')
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
            <button class="btn btn-primary" name="submit">Update</button> <!-- Change button text to 'Update' -->
            <a href="{{ route('worker.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
    // When material type is changed, fetch the materials
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

    // When a material is selected, fetch its price from grn_items
    $('#material').change(function() {
    var material_name = $(this).val();

    if (material_name) {
        $.ajax({
            url: '/get-material-price/' + material_name,
            type: 'GET',
            success: function(data) {
                $('#price').val(data.price);
                updateTotal(); // Update total based on the new price and quantity
            },
            error: function(xhr) {
                console.error('Error fetching material price:', xhr.responseText);
            }
        });
    } else {
        $('#price').val(''); // Clear price if no material is selected
        $('#total').val(''); // Clear total
    }
});


    // Function to update total when quantity or price changes
    function updateTotal() {
        const qty = parseFloat($('#qty').val()) || 0;
        const price = parseFloat($('#price').val()) || 0;
        const total = qty * price;
        $('#total').val(total.toFixed(2)); // Adjust decimal places as needed
    }

    // Event listeners for quantity and price inputs
    $('#qty, #price').on('input', updateTotal);
});

    </script>
@endsection
