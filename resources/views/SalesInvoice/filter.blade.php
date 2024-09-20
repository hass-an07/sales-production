@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sale Product Report</h1>
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
                        {{--  --}}
                    </div>
                </form>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="purchaseOrderTableBody">
                            <!-- Filtered purchase orders will be appended here by AJAX -->
                        </tbody>
                    </table>
                    <div class="card-footer px-5" style="background-color: #fff; border-top: 1px solid #dee2e6; text-align: right;">
                        <strong style="font-size: 1.2rem; color: #333;">Total Amount: </strong>
                        <span id="totalAmount" style="font-weight: bold; color: #007bff;">0.00</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Event listener for form submission or date input changes
    $('#from_date, #to_date').on('change', function () {
        filterReceivedProducts();
    });

    function filterReceivedProducts() {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();

        // AJAX request to fetch filtered records
        $.ajax({
            url: "{{ route('filterSaleProducts') }}", // Adjust based on your route name
            method: 'GET',
            data: {
                from_date: fromDate,
                to_date: toDate
            },
            success: function (receivedProducts) {
                $('#purchaseOrderTableBody').empty(); // Clear existing rows
                let totalAmount = 0; // Initialize total amount

                // Append new rows to the table and calculate total
                receivedProducts.forEach(function(product) {
                    $('#purchaseOrderTableBody').append(
                        `<tr>
                            <td>${product.product_code}</td>
                            <td>${product.product_name}</td>
                            <td>${product.product_qty}</td>
                            <td>${product.product_price}</td>
                            <td>${product.net_amount}</td>
                        </tr>`
                    );
                    totalAmount += parseFloat(product.net_amount); // Sum up the net_amount
                });

                // Display total amount
                $('#totalAmount').text(totalAmount.toFixed(2)); // Formatting to 2 decimal places
            },
            error: function (xhr) {
                console.error("Error: " + xhr.responseText);
            }
        });
    }
});


</script>
@endsection
