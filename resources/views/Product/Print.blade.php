<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Worker/Supplier</title>
    <meta name="author" content="themeholy">
    <meta name="description" content="Invar - Invoice HTML Template">
    <meta name="keywords" content="Invar - Invoice HTML Template" />
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="manifest" href="{{ asset('invoice/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('invoice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('invoice/css/style.css') }}">

    <style>
        /* Ensure the body and main content take up the full viewport */
        body, html {
            height: 100%;
            margin: 0;
        }
        
        .invoice-container-wrap {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .invoice-container {
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .table {
            margin: 0;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .invoice-button{

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
                            <h3 class="text-center">Registration List</h3>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->product_code ?? 'N/A' }}</td>
                                                <td>{{ $item->name ?? 'N/A' }}</td>
                                                <td>{{ $item->price ?? 'N/A' }}</td>                                       
                                                <td>{{ $item->status ?? 'N/A' }}</td>                                       
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-danger text-center">
                                                <h1>Rcords not found</h1>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice-button text-center">
                        <button class="print_btn btn btn-primary">Print</button>
                        {{-- <button id="download_btn" class="download_btn">Download</button> --}}
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('invoice/js/bootstrap.min.js') }}"></script>
    <script>
        document.querySelector('.print_btn').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>

</html>
