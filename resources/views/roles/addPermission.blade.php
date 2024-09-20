@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role : {{$role->name}}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('role.index') }}" class="btn btn-primary">Back</a>
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
            <form action="{{ route('givePermissionToRole', $role->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Role</label>
                                    <input type="text" name="name" id="name" value="{{$role->name}}" disabled class="form-control" 
                                           value="{{ old('name') }}" placeholder="Code">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Permission</label> <br>

                                    @foreach ($permissions as $permission)
                                        <input type="checkbox" value="{{ $permission->name }}" {{ in_array($permission->id , $rolePermission) ? 'checked' : '' }} name="permission[]" id="" class="mx-3">
                                        {{$permission->name}}
                                    @endforeach
                                   
                                    <span class="text-danger">
                                        @error('name')
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
            <a href="{{ route('role.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>

        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')

@endsection
