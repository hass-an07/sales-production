@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Requestion Report</h1>
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
                </form>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>requestion Id</th>
                            </tr>
                        </thead>
                        <tbody id="purchaseOrderTableBody">
                            <!-- Filtered purchase orders will be appended here by AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Event listener for date range and company filter changes
    $('#to_date, #company').on('change', function () {
        filterRecords();
    });

    function filterRecords() {
        // Get filter values
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
        var companyId = $('#company').val();

        // AJAX request to fetch filtered records
        $.ajax({
            url: "{{ route('filter.requestion') }}",
            method: 'GET',
            data: {
                from_date: fromDate,
                to_date: toDate,
                company: companyId
            },
            success: function (response) {
                // Clear the table or container where the records are displayed
                $('#purchaseOrderTableBody').empty();

                // Iterate through the filtered orders and append to the table or list
                $.each(response, function (index, order) {
                    $('#purchaseOrderTableBody').append(
                        `<tr>
                            <td>${order.date}</td>
                            <td><a href="#" class="requestion" data-requestion="${order.id}">${order.id}</a></td>
                        </tr>`
                    );
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Event listener for PO number clicks
    // Event listener for GRN number clicks
$(document).on('click', '.requestion', function (e) {
    e.preventDefault();

    // Get the GRN ID
    var requestion_id = $(this).data('requestion');
    console.log(requestion_id)

    // Redirect to the GRN report page with the GRN ID
    window.location.href = "{{ route('requestion.report', ':id') }}".replace(':id', requestion_id);
});

});
</script>
@endsection
