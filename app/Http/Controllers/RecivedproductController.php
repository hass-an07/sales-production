<?php

namespace App\Http\Controllers;

use App\Models\Recivedproduct;
use App\Http\Requests\StoreRecivedproductRequest;
use App\Http\Requests\UpdateRecivedproductRequest;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class RecivedproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $recivedproducts = Recivedproduct::
        when($keyword, function ($query) use ($keyword) {
            $query->where('date', 'like', '%' . $keyword . '%')  // Search by invoice number
                ->orWhere('product_name', 'like', '%' . $keyword . '%');
        })
        ->with('department')->paginate('10');
        return view('Recivedproduct.list', compact('recivedproducts'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('Recivedproduct.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecivedproductRequest $request)
    {
        // dd($request->all());
           // Validate the incoming request data
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
    $record = new Recivedproduct();
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
    return redirect()->route('recivedproduct.index')->with('success', 'Record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recivedproduct $recivedproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recivedproduct $recivedproduct)
    {
        $departments = Department::all();
        return view('Recivedproduct.edit',compact('recivedproduct','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecivedproductRequest $request, Recivedproduct $recivedproduct)
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
        $recivedproduct->update([
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
        return redirect()->route('recivedproduct.index')
                         ->with('success', 'Received product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recivedproduct $recivedproduct)
    {
        $recivedproduct->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }


    public function filterShow(){
        return view('Recivedproduct.filter');
    }
    public function filterReceivedProducts(Request $request)
{
    $fromDate = $request->from_date;
    $toDate = $request->to_date;

    $receivedProducts = Recivedproduct::whereDate('date', '>=', $fromDate)
                                        ->whereDate('date', '<=', $toDate)
                                        ->get();

    return response()->json($receivedProducts);
}
}
