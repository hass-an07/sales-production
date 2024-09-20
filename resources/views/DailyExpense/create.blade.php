@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Daily Expense</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('dailyExpense.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('dailyExpense.store') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('mesage')
                        <input type="hidden" name="created_by" value="{{ Auth::user()->id }}" id="">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" 
                                       value="{{ old('date') }}" placeholder="Code">
                                <span class="text-danger">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ex_code">Expense Code</label>
                                <select name="ex_code" id="ex_code" class="form-control">
                                    <option value="">--Select Expense Code--</option>
                                    @foreach ($dailyExpenses as $dailyExpense)
                                        <option value="{{$dailyExpense->ex_code}}">{{$dailyExpense->ex_code}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('ex_code')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ex_name">Expense Name</label>
                                <input type="text" name="ex_name" readonly id="ex_name" class="form-control" 
                                       value="{{ old('ex_name') }}" placeholder="Name">
                                <span class="text-danger">
                                    @error('ex_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount"  id="amount" class="form-control" 
                                       value="{{ old('amount') }}" placeholder="Amount">
                                <span class="text-danger">
                                    @error('amount')
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
        <a href="{{ route('dailyExpense.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
    </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customjs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#ex_code').change(function() {
            var ex_code = $(this).val();
            if (ex_code) {
                $.ajax({
                    url: '{{ url("get-expense-name") }}/' + ex_code,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ex_name').val(data.ex_name);
                    }
                });
            } else {
                $('#ex_name').val('');
            }
        });
    });
</script>
@endsection
