<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Requestion </title>
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
                            <h3 class="text-center" style="border: 2px solid black">Requestion</h3>
                            <h4 class="text-center" style="border: 2px solid black">{{ $requestion->company->company_name }}</h4>
                            <div class="" style="border: 2px solid black; display: flex; justify-content: space-between">
                                <div>
                                    <h5>Date: {{ $requestion->date }}</h5>
                                    <h5>Time :   {{ $requestion->time  }}</h5>
                                    <h5>Req No :   {{ $requestion->requisition  }}</h5>
                                </div>
                                <div>
                                    <h5>status: {{ $requestion->status }}</h5>
                                    <h5>store :   {{ $requestion->department->dept_name }}</h5>
                                    <h5>Reciver :   {{ $requestion->receiver }}</h5>
                                </div>
                            </div>
                            <table class="table table-hover text-nowrap my-4">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Material Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($requestions->isNotEmpty())
                                        @foreach ($requestions as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->material }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-danger text-center">
                                                <h3>Records not found</h3>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2"><h5>Grass Total: {{$requestion->total}}</h5></td>
                                    </tr> 
                                </tbody>
                                
                                
                            </table>
                            <div class="container mt-5">
                                <div class="row text-center">
                                    <div class="col-4">
                                        {{-- <div class="signature-line">
                                            <span>Required by</span>
                                        </div> --}}
                                    </div>
                                    <div class="col-4">
                                        {{-- <div class="signature-line">
                                        </div> --}}
                                    </div>
                                    <div class="col-4">
                                        <div class="signature-line">
                                            <span>Store Kepper</span>
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
