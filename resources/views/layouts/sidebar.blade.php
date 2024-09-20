<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset("img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LAFESA BREAD</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('company.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Company</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('department.index')}}" class="nav-link">
                        <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                          </svg>
                        <p>Department</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{route('department2.index')}}" class="nav-link">
                        <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                          </svg>
                        <p>Department 2</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{route('worker.index')}}" class="nav-link">
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Worker/Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('materialType.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Material Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('weightType.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Weight Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('material.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Material </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product.create')}}" class="nav-link">
                        <i class="nav-icon fas fa-tag"></i>
                        <p>Product </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('purchaseOrder.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Purchase Order </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('grn.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>GRN </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('requisition.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Requisition </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('recivedproduct.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Recived Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('salesinvoice.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Sales Invoice</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('outward.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Outward</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('registerExpense.create')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Expense Registration</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('dailyExpense.index')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Daily Expense</p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="nav-icon far fa-file-alt"></i> Reports
                    </a>
                    <ul class="dropdown-menu bg-dark text-white" aria-labelledby="reportsDropdown" >
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('purchase-order-filter')}}">Purchase Order</a></li>
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('grn-filter')}}">GRN</a></li>
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('requestion-filter')}}">Requisition</a></li>
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('recived-product-filter')}}">Recived Product</a></li>
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('sale-product-filter')}}">Sale Product</a></li>
                        <li><a class="dropdown-item bg-dark text-white" href="{{route('expense-filter')}}">Expense Report</a></li>
                        {{-- <li><a class="dropdown-item bg-dark text-white" href="{{route('store-filter')}}">Store Report</a></li> --}}
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('account.user')}}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Users</p>
                    </a> 
                </li>
                
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>