@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Outward</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('outward.index') }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('outward.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="returnable">Returnable</option>
                                        <option value="permanent">Permanent</option>
                                    </select>
                                    <span class="text-danger">@error('status'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="outward">Outward</label>
                                    <input type="text" name="outward" id="outward" class="form-control" 
                                           value="{{ old('outward') }}">
                                    <span class="text-danger">@error('outward'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="g_pass_no">G-Pass No</label>
                                    <input type="text" name="g_pass_no" id="g_pass_no" class="form-control" 
                                           value="{{ old('g_pass_no') }}">
                                    <span class="text-danger">@error('g_pass_no'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="outward_no">GRN No</label>
                                    <input type="text" name="outward_no" id="outward_no" class="form-control" 
                                           value="{{ old('outward_no') }}" placeholder="GRN NO">
                                    <span class="text-danger">@error('outward_no'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" 
                                           value="{{ old('date') }}">
                                    <span class="text-danger">@error('date'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="time">Time</label>
                                    <input type="time" value="{{ $currentTime }}" name="time" id="time"
                                        class="form-control">
                                    <span class="text-danger">@error('time'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle">Vehicle</label>
                                    <input type="text" name="vehicle" value="{{ old('vehicle') }}" id="vehicle" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="worker_id">Supplier</label>
                                    <select name="worker_id" id="worker_id" class="form-control">
                                        <option value="">--Select supplier--</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('worker_id'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="through">Through</label>
                                    <input type="text" name="through" id="through" class="form-control">
                                    <span class="text-danger">@error('through'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dept_id">Department</label>
                                    <select name="dept_id" id="dept_id" class="form-control">
                                        <option value="">--Select Department--</option>
                                        @foreach ($departments as $item)
                                            <option value="{{ $item->id }}">{{$item->dept_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('dept_id'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="materialType_id">Material Type</label>
                                    <select name="materialType_id" id="materialType_id" class="form-control material-type">
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
                                    <label for="material_id">Material</label>
                                    <select name="material_id" id="material_id" class="form-control material">
                                        <option value="">--select--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit_id">Unit</label>
                                    <select name="unit_id" id="unit_id" class="form-control unit">
                                        <option value="">--select--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="qty">Qty</label>
                                    <input type="number" name="qty" id="qty" class="form-control">
                                    <span class="text-danger">@error('qty'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="username" id="username" class="form-control">
                                    <span class="text-danger">@error('qty'){{ $message }}@enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3 mx-3">
                    <button class="btn btn-primary" name="submit">Create</button>
                    <a href="{{ route('outward.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')
<script>
    $(document).ready(function () {
        function loadMaterialsAndUnits(materialTypeId) {
            var materialSelect = $('#material_id');
            var unitSelect = $('#unit_id');

            materialSelect.empty().append('<option value="">--select--</option>');
            unitSelect.empty().append('<option value="">--select--</option>');

            if (materialTypeId) {
                $.ajax({
                    url: '/get-materials-and-units/' + materialTypeId,
                    type: 'GET',
                    success: function(data) {
                        $.each(data.materials, function(index, material) {
                            materialSelect.append('<option value="' + material.id + '">' + material.material + '</option>');
                            unitSelect.append('<option value="' + material.id + '">' + material.unit + '</option>');
                        });
                        // $.each(data.units, function(index, unit) {
                        // });
                    },
                    error: function(xhr) {
                        console.error('Error fetching materials and units:', xhr.responseText);
                    }
                });
            }
        }

        // Load materials and units when material type is selected
        $(document).on('change', '#materialType_id', function() {
            var materialTypeId = $(this).val();
            loadMaterialsAndUnits(materialTypeId);
        });
    });
</script>
@endsection
