<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DailyExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentTwoController;
use App\Http\Controllers\ExpenseregistrationController;
use App\Http\Controllers\GrnController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\OutwardController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RecivedproductController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesinvoiceController;
use App\Http\Controllers\StoreReportController;
use App\Http\Controllers\WeightTypeController;
use App\Http\Controllers\WorkerController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthenticateController::class, 'login'])->name('account.login');
Route::post('/login', [AuthenticateController::class, 'authenticate'])->name('account.authenticate');
Route::get('/register', [AuthenticateController::class, 'register'])->name('account.register');
Route::post('/process-register', [AuthenticateController::class, 'processregister'])->name('account.processregister');

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/user', [AuthenticateController::class, 'user'])->name('account.user');
    Route::get('/edit-user/{id}', [AuthenticateController::class, 'edit'])->name('user.edit');
    Route::put('/edit-user/{id}', [AuthenticateController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [AuthenticateController::class, 'destroy'])->name('user.destroy');
    Route::get('/role', [AuthenticateController::class, 'role'])->name('account.role');
    Route::post('/storeRole', [AuthenticateController::class, 'storeRole'])->name('storeRole');
    
    Route::get('/', function () {
        return view('dashboard.dashboard');
    });


    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/company', CompanyController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/department2', DepartmentTwoController::class);
    Route::resource('/worker', WorkerController::class);
    Route::resource('/materialType', MaterialTypeController::class);
    Route::resource('/weightType', WeightTypeController::class);
    Route::resource('/material', MaterialController::class);
    Route::resource('/purchaseOrder', PurchaseOrderController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/grn', GrnController::class);
    Route::resource('/requisition', RequisitionController::class);
    Route::resource('/recivedproduct', RecivedproductController::class);
    Route::resource('/salesinvoice', SalesinvoiceController::class);
    Route::resource('/outward', OutwardController::class);
    Route::resource('/registerExpense', ExpenseregistrationController::class);
    Route::resource('/dailyExpense', DailyExpenseController::class);
    Route::get('/edit-dailyExpense/{id}', [DailyExpenseController::class, 'editDailyExpense'])->name('editDailyExpense');
    Route::get('/edit/{id}', [ExpenseregistrationController::class, 'editRegisterExpense'])->name('editRegisterExpense');
    Route::get('/get-materials/{material_type_id}', [PurchaseOrderController::class, 'getMaterialsByType']);
    Route::get('/print', [WorkerController::class, 'print'])->name('print');
    Route::get('/logout', [AuthenticateController::class, 'logout'])->name('account.logout');
    Route::get('get-expense-name/{ex_code}', [DailyExpenseController::class, 'getExpenseName']);


    // Route::get('/get-po-numbers/{companyId}', [GrnController::class, 'getPoNumbers']);
    Route::get('/get-po-numbers/{companyId}', [GrnController::class, 'getPONumbers']);
    Route::get('/printProduct', [ProductController::class, 'print'])->name('printProduct');

    Route::get('/get-po-details/{poId}', [GrnController::class, 'getPODetails']);
    Route::get('/get-po-materialdetails/{poId}', [GrnController::class, 'getPoMaterialdetails']);
    // Route::get('/get-material-price/{material_id}', [RequisitionController::class, 'getMaterialPrice']);
    Route::get('/get-material-price/{material_name}', [RequisitionController::class, 'getMaterialPrice']);

    Route::get('/get-materials-and-units/{materialTypeId}', [OutwardController::class, 'getMaterialsAndUnits']);


    // Route::post('/purchaseOrder/store-materials', [PurchaseOrderController::class, 'storeMaterials'])->name('purchaseOrder.storeMaterials');



    // purcahase order filetrs
    Route::get('/purchase-order-filter', [PurchaseOrderController::class, 'filterShow'])->name('purchase-order-filter');
    Route::get('/filter-purchase-orders', [PurchaseOrderController::class, 'filter'])->name('purchaseOrders.filter');
    Route::get('/purchaseOrders/materials', [PurchaseOrderController::class, 'getMaterialsByPoNumber'])->name('purchaseOrders.getMaterials');
    Route::get('/purchaseOrders/report', [PurchaseOrderController::class, 'showReport'])->name('purchaseOrders.report');


    // Grn filetrs
    Route::get('/grn-filter', [GrnController::class, 'filterShow'])->name('grn-filter');
    Route::get('/filter-grn', [GrnController::class, 'filter'])->name('grn.filter');
    Route::get('/grn-report/{id}', [GrnController::class, 'showReport'])->name('grn.report');
    
    // requestion reports
    Route::get('/requestion-filter', [RequisitionController::class, 'filterShow'])->name('requestion-filter');
    Route::get('/filter-requestion', [RequisitionController::class, 'filter'])->name('filter.requestion');
    Route::get('/requestion-report/{id}', [RequisitionController::class, 'showReport'])->name('requestion.report');
    
    // store reports
    Route::get('/store-filter', [StoreReportController::class, 'filterShow'])->name('store-filter');
    
    // recieved product filters
    Route::get('/recived-product-filter', [RecivedproductController::class, 'filterShow'])->name('recived-product-filter');
    Route::get('/filterReceivedProducts', [RecivedproductController::class, 'filterReceivedProducts'])->name('filterReceivedProducts');

    // sale product filters
    Route::get('/sale-product-filter', [SalesinvoiceController::class, 'filterShow'])->name('sale-product-filter');
    Route::get('/filterSaleProducts', [SalesinvoiceController::class, 'filterSaleProducts'])->name('filterSaleProducts');

    // sexpense filters
    Route::get('/expense-filter', [DailyExpenseController::class, 'filterShow'])->name('expense-filter');
    Route::get('/filterExpense', [DailyExpenseController::class, 'filterExpense'])->name('filterExpense');
    
    
    Route::get('/filterExpense', [DailyExpenseController::class, 'filterExpense'])->name('filterExpense');
    
    // permisson
    Route::resource('/permission', permissionController::class);
    
    // roles
    Route::resource('/role', RoleController::class);
    Route::get('/add-or-update/{id}', [RoleController::class, 'addOrUpdatePermission'])->name('addOrUpdatePermission');
    Route::put('/roles/{id}/give-permission', [RoleController::class, 'givePermissionToRole'])->name('givePermissionToRole');
});
