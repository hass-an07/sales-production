@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Purcahse Order</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('purchaseOrder.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('purchaseOrder.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="po_number" value="{{ $poNumber }}">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" 
                                           value="{{ old('date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
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
                                            <option value="{{ $company->id }}">
                                                {{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_number">PO Number</label>
                                    <input type="text" value="{{ $poNumber }}" readonly name="po_number" id="po_number"
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
                                            <option value="{{ $department->id }}">
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
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->name }}">
                                                {{ $worker->name }}
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
                                            <option value="{{ $department->id }}">
                                                {{ $department->dept_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="items-container">
                                <div class="item-entry row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="material_type">Material Type</label>
                                            <select name="material_type[]" class="form-control material-type">
                                                <option value="">--select--</option>
                                                @foreach ($materialTypes as $materialType)
                                                    <option value="{{ $materialType->id }}">
                                                        {{ $materialType->material_type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="material">Material</label>
                                            <select name="material[]" class="form-control material">
                                                <option value="">--select--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="quantity">QTY</label>
                                            <input type="text" name="quantity[]" class="form-control" placeholder="Quantity">
                                            <span class="text-danger">
                                                @error('quantity')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 list-po-no-wrapper">
                                        <div class="mb-3">
                                            <label for="list_po_no">List Po No</label>
                                            <input type="text" name="list_po_no[]" value="{{ $poNumber }}" readonly class="form-control" placeholder="List Po No">
                                            <span class="text-danger">
                                                @error('list_po_no')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <button type="button" id="add-item" class="btn btn-secondary">Add Another Item</button>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3 mx-3">
                    <button class="btn btn-primary" name="submit">Create</button>
                    <a href="{{ route('purchaseOrder.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>

            @if(session('lastCreatedOrder'))
                <!-- Table displaying the newly created purchase order and materials -->
                <div class="card mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Recently Created Purchase Order</h3>
                    </div>
                    <div class="card-body">
                        <h5>Purchase Order Details:</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ session('lastCreatedOrder')->id }}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ session('lastCreatedOrder')->date }}</td>
                            </tr>
                            <tr>
                                <th>Company Name</th>
                                <td>{{ session('lastCreatedOrder')->company->company_name }}</td>
                            </tr>
                            <tr>
                                <th>PO Number</th>
                                <td>{{ session('lastCreatedOrder')->po_number }}</td>
                            </tr>
                            <tr>
                                <th>From Department</th>
                                <td>{{ session('lastCreatedOrder')->from->dept_name }}</td>
                            </tr>
                            <tr>
                                <th>For Department</th>
                                <td>{{ session('lastCreatedOrder')->for->dept_name }}</td>
                            </tr>
                            <tr>
                                <th>Worker Name</th>
                                <td>{{ session('lastCreatedOrder')->name }}</td>
                            </tr>
                        </table>

                        <h5>Material Details:</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Material Type</th>
                                    <th>Material</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('createdMaterials') as $material)
                                    <tr>
                                        <td>{{ $material->material_type }}</td>
                                        <td>{{ $material->material }}</td>
                                        <td>{{ $material->quantity }}</td>
                                        {{-- <td>
                                            <!-- Edit and Delete buttons for each material -->
                                            <a href="{{ route('purchaseOrder.editMaterial', $material->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            <form action="{{ route('purchaseOrder.deleteMaterial', $material->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Edit and Delete buttons for the Purchase Order -->
                        <div class="mt-4">
                            {{-- <a href="{{ route('purchaseOrder.edit', session('lastCreatedOrder')->id) }}" class="btn btn-info">Edit Purchase Order</a> --}}
                            <form action="{{ route('purchaseOrder.destroy', session('lastCreatedOrder')->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Purchase Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('customjs')
<script>
 $(document).ready(function() {
    // Function to load materials based on the selected material type
    function loadMaterials(selectElement) {
        var materialTypeId = $(selectElement).val();
        var materialSelect = $(selectElement).closest('.item-entry').find('.material');

        materialSelect.empty().append('<option value="">--select--</option>');

        if (materialTypeId) {
            $.ajax({
                url: '/get-materials/' + materialTypeId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, material) {
                        materialSelect.append('<option value="' + material.material + '">' + material.material + '</option>');
                    });
                }
            });
        }
    }

    // Load materials when material type is selected
    $(document).on('change', '.material-type', function() {
        loadMaterials(this);
    });

    // Add another item entry
    $('#add-item').on('click', function() {
        var itemEntry = $('#items-container .item-entry:first').clone();
        
        // Clear input values and reset selects
        itemEntry.find('input').val('');
        itemEntry.find('select').val('');
        itemEntry.find('.material').empty().append('<option value="">--select--</option>');
        
        // Remove List Po No from cloned item
        itemEntry.find('.list-po-no-wrapper').remove();
        
        // Append the new item to the container
        $('#items-container').append(itemEntry);
    });
});

</script>
@endsection
