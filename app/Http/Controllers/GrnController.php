<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use App\Http\Requests\StoreGrnRequest;
use App\Http\Requests\UpdateGrnRequest;
use App\Models\Company;
use App\Models\GrnItem;
use App\Models\Purcahsematerial;
use App\Models\PurchaseOrder;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grns = Grn::with('company', 'worker')->paginate(10);
        return view('Grn.list', compact('grns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $suppliers = Worker::all();

        // Get the last invoice number from the session
        $lastInvoiceNumber = session('last_invoice_number', 1000); // Default to 1000 if no session value exists

        // Increment the invoice number
        $newInvoiceNumber = 'INV-' . ($lastInvoiceNumber + 1);


        // Store the new invoice number in the session
        session(['last_invoice_number' => $lastInvoiceNumber + 1]);

        return view('Grn.create', compact('companies', 'newInvoiceNumber', 'suppliers'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrnRequest $request)
    {
        // Validate the incoming request
        $request->validate([
            'company_id' => 'required',
            'supplier_id' => 'required',
            'po_date' => 'nullable|date',
            'po_order_no' => 'nullable|string|max:255',
            'grn_no' => 'nullable|string|max:255',
            'invoice_no' => 'required|string|unique:grns,invoice_no|max:255',
            'grndate' => 'nullable|date',
            'loPONO' => 'nullable|string|max:255',
            'total_amount' => 'nullable|numeric',
            'materials.*' => 'required|string|max:255', // Assuming material names are strings
            'qty.*' => 'required|numeric',
            'price.*' => 'required|numeric',
            'total.*' => 'required|numeric',
        ]);

        // Store the GRN data
        $grn = new Grn();
        $grn->company_id = $request->input('company_id');
        $grn->supplier_id = $request->input('supplier_id');
        $grn->po_date = $request->input('po_date');
        $grn->po_order_no = $request->input('po_order_no');
        $grn->grn_no = $request->input('grn_no');
        $grn->invoice_no = $request->input('invoice_no');
        $grn->grn_date = $request->input('grndate');
        $grn->lo_pono = $request->input('loPONO');
        $grn->total_amount = $request->input('total_amount');

        // Save the GRN data first
        $grn->save();

        // Now, store the items related to this GRN
        $materials = $request->input('materials', []);
        $quantities = $request->input('qty', []);
        $prices = $request->input('price', []);
        $totals = $request->input('total', []);

        foreach ($materials as $index => $material) {
            $grnItem = new GrnItem();
            $grnItem->grn_id = $grn->id;
            $grnItem->material = $material;
            $grnItem->quantity = $quantities[$index];
            $grnItem->price = $prices[$index];
            $grnItem->total = $totals[$index];
            $grnItem->save();
        }

        // Redirect to the GRN index page with a success message
        return redirect()->route('grn.index')->with('success', 'GRN created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Grn $grn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grn $grn)
    {
        $companies = Company::all();
        $suppliers = Worker::all();
        return view('Grn.edit', compact('grn', 'companies', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateGrnRequest $request, Grn $grn)
    // {
    //     // Validate input
    //     $validator = Validator::make($request->all(), [
    //         'company_id' => 'required',
    //         'supplier_id' => 'required',
    //         'po_date' => 'nullable|date',
    //         'po_order_no' => 'nullable|string|max:255',
    //         'grn_no' => 'nullable|string|max:255',
    //         'invoice_no' => 'required',
    //         'grndate' => 'nullable|date',
    //         'loPONO' => 'nullable|string|max:255',
    //         'total_amount' => 'nullable|numeric',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Find the GRN to update

    //     // Update the GRN data
    //     $grn->company_id = $request->input('company_id');
    //     $grn->po_date = $request->input('po_date');
    //     $grn->po_order_no = $request->input('po_order_no');
    //     $grn->grn_no = $request->input('grn_no');
    //     $grn->invoice_no = $request->input('invoice_no');
    //     $grn->grn_date = $request->input('grn_date');
    //     $grn->supplier_id = $request->input('supplier_id');
    //     $grn->lo_pono = $request->input('lo_pono');
    //     $grn->total_amount = $request->input('total_amount');

    //     // Save the updated GRN
    //     $grn->save();

    //     // Redirect to the index with success message
    //     return redirect()->route('grn.index')->with('success', 'GRN updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grn $grn)
    {
        $grn->delete();

        return redirect()->route('grn.index')->with('success', 'GRN deleted successfully.');
    }
    public function getPONumbers($companyId)
    {
        // Fetch PO numbers based on companyId
        $pos = PurchaseOrder::where('company_id', $companyId)->get();
        return response()->json($pos);
    }

    public function getPODetails($poId)
    {
        // Fetch PO details based on poId
        $po = PurchaseOrder::find($poId);
        return response()->json([
            'supplier_name' => $po->name,
            'grn_number' => $po->grn_number,
            'po_number' => $po->po_number,
            'po_date' => $po->date,
            'total_amount' => $po->total_amount,
        ]);
    }
    public function getPoMaterialDetails($poId)
    {
        // Fetch purchase order based on the PO number ID
        $purchaseOrder = PurchaseOrder::find($poId);

        if ($purchaseOrder) {
            // Fetch related materials including material type based on the PO number
            $materials = Purcahsematerial::with('materialType')->where('po_number_id', $purchaseOrder->id)->get();

            return response()->json($materials);
        } else {
            return response()->json(['error' => 'Purchase order not found'], 404);
        }
    }

    public function filterShow(){
        $companies = Company::all();
        return view('Grn.filter',compact('companies'));
    }
    public function filter(Request $request)
{
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $companyId = $request->input('company');

    $query = Grn::query();

    if ($fromDate && $toDate) {
        $query->whereBetween('grn_date', [$fromDate, $toDate]);
    }

    if ($companyId) {
        $query->where('company_id', $companyId);
    }

    $filteredOrders = $query->with('company')->get();

    return response()->json($filteredOrders);
}

// GrnController.php
public function showReport($id)
{
    // Fetch the GRN record by ID
    $grn = Grn::with('company')->find($id);
    $grn_id = $grn->id;
    // dd($grn_id);
    $grn_item = GrnItem::where('grn_id', $grn_id)->get();
    // dd($grn_item);

    if (!$grn) {
        return redirect()->back()->with('error', 'GRN not found.');
    }

    // Return the view with GRN data and its items
    return view('Grn.report', compact('grn','grn_item'));
}

}
