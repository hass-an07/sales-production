@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create GRN</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('grn.index') }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('grn.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @include('mesage')

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="company_id">Company</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('company_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_date">P.O Date</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"
                                        value="{{ old('po_date') }}">
                                    <span class="text-danger">
                                        @error('po_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="po_order_no">P.Order No</label>
                                    <select name="po_order_no" id="po_order_no" class="form-control">
                                        <option value="">Select P.Order No</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('po_order_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="grn_no">GRN No</label>
                                    <input type="text" name="grn_no" id="grn_no" class="form-control"
                                        value="{{ old('grn_no') }}" placeholder="GRN NO">
                                    <span class="text-danger">
                                        @error('grn_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="invoice_no">Invoice Number</label>
                                    <input type="text" name="invoice_no" id="invoice_no" class="form-control"
                                        value="{{ $newInvoiceNumber }}" readonly>
                                    <span class="text-danger">
                                        @error('invoice_no')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="grndate">G.R.N Date</label>
                                    <input type="date" name="grndate" value="{{ old('grndate') }}" id="grndate"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="supplier_id">Supplier</label>
                                    <input type="text" name="supplier_id" readonly id="supplier_id" class="form-control">
                                    <span class="text-danger">
                                        @error('supplier_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="loPONO">List of P.O No</label>
                                    <input type="text" name="loPONO" id="loPONO" readonly class="form-control">
                                    <span class="text-danger">
                                        @error('loPONO')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <table id="materialTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Material rows will be appended here by JavaScript -->
                                </tbody>
                            </table>
                            
                            <div>
                                <label for="total_amount">Total Amount</label>
                                <input type="number" id="total_amount" name="total_amount" class="form-control" value="0" readonly>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3 mx-3">
                    <button class="btn btn-primary" name="submit">Create</button>
                    <a href="{{ route('grn.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customjs')
<script>
    $(document).ready(function() {

        function calculateRowTotal() {
            $('#materialTable tbody tr').each(function() {
                var qty = parseFloat($(this).find('.qty').val()) || 0;
                var price = parseFloat($(this).find('.price').val()) || 0;
                var total = qty * price;
                $(this).find('.total').val(total.toFixed(2));
            });
        }

        function calculateTotalAmount() {
            var totalAmount = 0;
            $('#materialTable tbody .total').each(function() {
                var rowTotal = parseFloat($(this).val()) || 0;
                totalAmount += rowTotal;
            });
            $('#total_amount').val(totalAmount.toFixed(2));
        }

        $('#materialTable').on('input', '.qty, .price', function() {
            calculateRowTotal();
            calculateTotalAmount();
        });

        $(document).ready(function() {
            // Fetch P.O numbers when a company is selected
            $('#company_id').on('change', function() {
                var companyId = $(this).val();
                var poSelect = $('#po_order_no');

                // Clear existing options and add default
                poSelect.empty().append('<option value="">Select P.Order No</option>');

                if (companyId) {
                    $.ajax({
                        url: '/get-po-numbers/' + companyId,
                        type: 'GET',
                        success: function(data) {
                            // Append options with P.O numbers formatted with leading zeros
                            $.each(data, function(index, po) {
                                var poNumberFormatted = po.po_number.toString().padStart(3, '0');
                                poSelect.append('<option value="' + po.id + '">' + poNumberFormatted + '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching P.O numbers:', xhr.responseText);
                        }
                    });
                }
            });

            // Fetch P.O details when a specific P.O number is selected
            $('#po_order_no').on('change', function() {
                var poId = $(this).val();

                if (poId) {
                    // Fetch P.O details based on the selected P.O number
                    $.ajax({
                        url: '/get-po-details/' + poId,
                        type: 'GET',
                        success: function(data) {
                            $('#supplier_id').val(data.supplier_name); // Use supplier_id here
                            $('#grn_no').val(data.grn_number);
                            $('#loPONO').val(data.po_number);
                            $('#po_date').val(data.po_date);
                            $('#total_amount').val(data.total_amount);
                        },
                        error: function(xhr) {
                            console.error('Error fetching P.O details:', xhr.responseText);
                        }
                    });

                    // Fetch related material details based on the selected P.O number
                    $.ajax({
    url: '/get-po-materialdetails/' + poId,
    type: 'GET',
    success: function(materials) {
        // Populate materials table or list
        let materialTable = $('#materialTable tbody');
        materialTable.empty(); // Clear existing rows

        $.each(materials, function(index, material) {
            let row = '<tr>' +
                '<td><input type="text" name="materials[]" class="form-control" value="' + material.material + '" readonly></td>' +
                '<td><input type="number" name="qty[]" class="qty form-control" value="' + material.quantity + '"></td>' +
                '<td><input type="number" name="price[]" class="price form-control" value="0"></td>' +
                '<td><input type="number" name="total[]" class="total form-control" value="0" readonly></td>' +
                '</tr>';
            materialTable.append(row);
        });

        // Recalculate totals after loading data
        calculateRowTotal();
        calculateTotalAmount();
    },
    error: function(xhr) {
        console.error('Error fetching P.O material details:', xhr.responseText);
    }
});

                }
            });
        });

        // Initial calculation on page load
        calculateRowTotal();
        calculateTotalAmount();
    });
</script>
@endsection
