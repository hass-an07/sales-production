@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update worker/supplier</h1>
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
            {{-- @if ($errors->all())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $eror)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif --}}
            <form action="{{ route('worker.update',$worker->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="dept_id">Department</label>
                                    <select name="dept_id" id="dept_id" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" 
                                            {{ $worker->dept_id == $department->id ? 'selected' : '' }}>
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
                                    <label for="worker_code">Code</label>
                                    <input type="text" value="{{ $worker->worker_code }}" name="worker_code" id="worker_code"
                                        class="form-control" placeholder="Code">
                                    <span class="text-danger">
                                        @error('worker_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $worker->name }}" name="name" id="name"
                                        class="form-control" placeholder="Name">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reference">Reference</label>
                                    <input type="text" value="{{ $worker->reference }}" name="reference" id="reference"
                                        class="form-control" placeholder="Reference">
                                    <span class="text-danger">
                                        @error('reference')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="age">Age</label>
                                    <input type="number" value="{{ $worker->age }}" name="age" id="age"
                                        class="form-control" placeholder="age">
                                    <span class="text-danger">
                                        @error('age')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cnic">NIC</label>
                                    <input type="number" value="{{ $worker->cnic }}" name="cnic" id="cnic"
                                        class="form-control" placeholder="NIC">
                                    <span class="text-danger">
                                        @error('cnic')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact">Contact</label>
                                    <input type="number" value="{{ $worker->contact }}" name="contact" id="contact"
                                        class="form-control" placeholder="Contact">
                                    <span class="text-danger">
                                        @error('contact')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="number" value="{{ $worker->address }}" name="address" id="address"
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
        </div>
        <div class="pb-5 pt-3 mx-3">
            <button class="btn btn-primary" name="submit">Update</button>
            <a href="{{ route('worker.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')
    {{-- <script>
    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:  "{{ route('temp-images.create') }}",
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        //console.log(response)
    }
});
</script> --}}
@endsection
