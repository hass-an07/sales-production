<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Purchase Order Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('invoice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('invoice/css/style.css') }}">
    <style>
        .signature-line {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .signature-line::before {
            content: "";
            border-top: 1px solid #000;
            width: 100%;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="invoice-container-wrap">
        <div class="invoice-container">
            <main>
                <div class="themeholy-invoice invoice_style4">
                    <div class="download-inner" id="download_section">
                        <div class="card-body table-responsive p-0">
                            <h3 class="text-center" style="border: 2px solid black">Purchase Order Note</h3>
                            <h4 class="text-center" style="border: 2px solid black">{{ $purchaseOrder->company->company_name }}</h4>
                            <div class="" style="border: 2px solid black; display: flex; justify-content: space-between">
                                <div>
                                    <h5>PO Number: {{ $poNumber }}</h5>
                                    <h5>Sullpier :   {{ $purchaseOrder->name }}</h5>
                                </div>
                                <div>
                                    <h5>Date: {{ $purchaseOrder->date }}</h5>
                                    <h5>Sullpier :   {{ $purchaseOrder->for->dept_name }}</h5>
                                </div>
                            </div>
                            <table class="table table-hover text-nowrap my-4">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($purchaseMaterials->isNotEmpty())
                                        @foreach ($purchaseMaterials as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->material }}</td>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-danger text-center">
                                                <h3>Records not found</h3>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="container mt-5">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="signature-line">
                                            <span>Required by</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="signature-line">
                                            <span>Head of Department</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="signature-line">
                                            <span>Approved by</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-button text-center">
                        <button class="print_btn btn btn-primary">Print</button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="{{ asset('invoice/js/bootstrap.min.js') }}"></script>
    <script>
        document.querySelector('.print_btn').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>
