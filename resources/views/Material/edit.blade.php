@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>update Material</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('department.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        
        <form action="{{ route('material.update',$material->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage')
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                        <div class="card-title col-6">
                            <div class="mb-3">
                                <label for="material_type_id">Material Type</label>
                                <select name="material_type_id" id="material_type_id" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach ($materialType as $materialTypes)
                                    <option value="{{$materialTypes->id}}" {{ $materialTypes->id == $material->material_type_id ? 'selected' : '' }}>
                                        {{ $materialTypes->material_type }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('material_type_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-title col-6">
                            <div class="mb-3">
                                <label for="unit">Weight Type</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach ($weightTypes as $weightType)
                                        <option value="{{ $weightType->weight_type }}" {{ $weightType->weight_type == $material->unit ? 'selected' : '' }}>
                                            {{ $weightType->weight_type }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('unit')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="card-title col-6">
                            <div class="mb-3">
                                <label for="material">Material</label>
                                <input type="text" value="{{ $material->material }}" name="material"
                                    id="material" class="form-control" placeholder="Material Name">
                                <span class="text-danger">
                                    @error('material')
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
                <a href="{{route('material.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>

    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customjs')

@endsection