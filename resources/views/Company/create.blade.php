@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Member</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('company.index') }}" class="btn btn-primary">Back</a>
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
            <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" value="{{ old('company_name') }}" name="company_name"
                                        id="company_name" class="form-control" placeholder="Company Name">
                                    <span class="text-danger">
                                        @error('company_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="owner_name">Owner Name</label>
                                    <input type="text" value="{{ old('owner_name') }}" name="owner_name" id="owner_name"
                                        class="form-control" placeholder="first name">
                                    <span class="text-danger">
                                        @error('owner_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" value="{{ old('address') }}" name="address" id="address"
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
            <button class="btn btn-primary" name="submit">Create</button>
            <a href="{{ route('company.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
