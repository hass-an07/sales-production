<?php

namespace App\Http\Controllers;

use App\Models\Salesinvoice;
use App\Http\Requests\StoreSalesinvoiceRequest;
use App\Http\Requests\UpdateSalesinvoiceRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class SalesinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $salesinvoices = Salesinvoice::
        when($keyword, function ($query) use ($keyword) {
            $query->where('date', 'like', '%' . $keyword . '%')  // Search by invoice number
                ->orWhere('product_name', 'like', '%' . $keyword . '%');
        })
        ->with('department')->paginate('10');
        return view('SalesInvoice.list', compact('salesinvoices'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('SalesInvoice.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesinvoiceRequest $request)
    {
        $request->validate([
            'date' => 'required|date',
            'dept_id' => 'nullable|exists:departments,id',
            'reciver_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_qty' => 'required|integer',
            'net_amount' => 'required|numeric',
        ]);
    
        // Create a new record in the database
        $record = new Salesinvoice();
        $record->date = $request->date;
        $record->dept_id = $request->dept_id; // Nullable, will handle null values
        $record->reciver_name = $request->reciver_name;
        $record->product_code = $request->product_code;
        $record->product_name = $request->product_name;
        $record->product_price = $request->product_price;
        $record->product_qty = $request->product_qty;
        $record->net_amount = $request->net_amount;
    
        // Save the record to the database
        $record->save();
    
        // Return a response or redirect as needed
        return redirect()->route('salesinvoice.index')->with('success', 'Sales Invoice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salesinvoice $salesinvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salesinvoice $salesinvoice)
    {
        $departments = Department::all();
        return view('SalesInvoice.edit',compact('salesinvoice','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesinvoiceRequest $request, Salesinvoice $salesinvoice)
    {
        $request->validate([
            'date' => 'required|date',
            'dept_id' => 'nullable|exists:departments,id',
            'reciver_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_qty' => 'required|integer|min:0',
            'net_amount' => 'required|numeric|min:0',
        ]);
    
        // Find the received product by its ID
    
        // Update the received product with the validated data
        $salesinvoice->update([
            'date' => $request->date,
            'dept_id' => $request->dept_id,
            'reciver_name' => $request->reciver_name,
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_qty' => $request->product_qty,
            'net_amount' => $request->net_amount,
        ]);
    
        // Redirect back to the index page with a success message
        return redirect()->route('salesinvoice.index')
                         ->with('success', 'Received product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salesinvoice $salesinvoice)
    {
        //
    }
    public function filterShow(){
        return view('SalesInvoice.filter');
    }

    public function filterSaleProducts(Request $request)
{
    $fromDate = $request->from_date;
    $toDate = $request->to_date;

    $receivedProducts = Salesinvoice::whereDate('date', '>=', $fromDate)
                                        ->whereDate('date', '<=', $toDate)
                                        ->get();

    return response()->json($receivedProducts);
}
}
