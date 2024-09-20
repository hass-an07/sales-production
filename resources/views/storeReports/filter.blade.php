@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Store Reports</h1>
                </div>
                {{-- <div class="col-sm-6 text-right">
                    <a href="{{ route('purchaseOrder.create') }}" class="btn btn-primary">Add Grn</a>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Main content section showing purchase orders -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="{{ route('purchaseOrder.index') }}" method="GET">
                    <div class="card-header">
                        @include('mesage') 
                        <div class="card-title d-flex">
                            <div>
                                <label for="from_date">From</label>
                                <input type="date" class="form-control" name="from_date" id="from_date">
                            </div>
                            <div class="mx-3">
                                <label for="to_date">To</label>
                                <input type="date" class="form-control" name="to_date" id="to_date">
                            </div>
                        </div>
                        <div class="card-tools" style="width: 400px">
                            <label for="company">Company</label>
                            <select name="company" class="form-control" id="company">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-header">
                        @include('mesage') 
                        <div class="card-title">
                            {{-- <div class="d-flex items-center">
                                <label for="store">Store</label>
                                <select name="store" id="">
                                    @foreach ($requesions as $requesion)
                                    <option value="">{{$requesion->store}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="d-flex items-center my-4">
                                <label for="product_type">Product Type</label>
                                {{-- @foreach ($product as )
                                    
                                @endforeach --}}
                                <input type="date" class="form-control mx-5" name="product_type" id="to_date">
                            </div>
                        </div>
                    
                    </div>
                </form>

                <div class="card-body table-responsive p-0">

                    <ul style="list-style: none">
                        <li><h4>Stock Details</h4></li>
                        <li><h4><a href=" " style="text-decoration: none;color: black">Recieved</a> </h4></li>
                        <li><h4>Issued</h4></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>
@endsection
