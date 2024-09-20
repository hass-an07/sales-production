<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\Purcahsematerial;
use App\Models\Worker;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $keyword = $request->get('keyword');
        $purchaseOrder = PurchaseOrder::when($keyword, function ($query) use ($keyword) {
            $query->where('date', 'like', '%' . $keyword . '%')  // Search by invoice number
                ->orWhere('name', 'like', '%' . $keyword . '%');
        })
            ->with('company', 'from', 'for','purcahsematerial')->paginate(10);
        return view('PurchaseOrder.list', compact('purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $departments = Department::all();
        $materialTypes = MaterialType::all();
        $workers = Worker::all();
        $lastPO = PurchaseOrder::latest()->first();  
        $serialNumber = $lastPO ? $lastPO->id + 1 : 1;
        
        // Format the po_number as po-001, po-002, etc.
        $poNumber =  str_pad($serialNumber, 3, '0', STR_PAD_LEFT);
        
        // Now you can save $poNumber into the database
        
        return view('PurchaseOrder.create', compact('companies', 'departments', 'materialTypes','poNumber','workers'));
    }

    public function getMaterialsByType($material_type_id)
    {
        $materials = Material::where('material_type_id', $material_type_id)->get();
        return response()->json($materials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'created_by' => 'required|integer',
        'date' => 'required',
        'company_id' => 'required',
        'po_number' => 'required',
        'from_id' => 'required',
        'name' => 'required|string',
        'for_id' => 'required',
        'material_type.*' => 'required',
        'material.*' => 'required',
        'quantity.*' => 'required',
        'list_po_no.*' => 'nullable|string',
    ]);

    // Create a new purchase order record in purchase_orders table
    $purchaseOrder = new PurchaseOrder();
    $purchaseOrder->created_by = $request->created_by;
    $purchaseOrder->date = $request->date;
    $purchaseOrder->company_id = $request->company_id;
    $purchaseOrder->po_number = $request->po_number;
    $purchaseOrder->from_id = $request->from_id;
    $purchaseOrder->name = $request->name;
    $purchaseOrder->for_id = $request->for_id;
    $purchaseOrder->save();

    // Save materials related to this purchase order in purchasematerials table
    $createdMaterials = [];
    foreach ($request->material_type as $index => $materialType) {
        $Purcahsematerial = new Purcahsematerial();  // Assuming model name is PurchaseMaterial
        $Purcahsematerial->po_number_id = $purchaseOrder->po_number; // Linking with PO number in purchase_orders table
        $Purcahsematerial->material_type = $materialType;
        $Purcahsematerial->material = $request->material[$index];
        $Purcahsematerial->quantity = $request->quantity[$index];
        // $Purcahsematerial->list_po_no = $request->list_po_no[$index] ?? null;
        
        // Save each material record
        $Purcahsematerial->save();
        
        // Collect created materials
        $createdMaterials[] = $Purcahsematerial;
    }

    // Pass the purchase order and the related materials to the view
    return redirect()->route('purchaseOrder.create')->with([
        'lastCreatedOrder' => $purchaseOrder,
        'createdMaterials' => $createdMaterials,
    ]);
}






    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $companies = Company::all();
        $departments = Department::all();
        $materialTypes = MaterialType::all();
        $workers = Worker::all();
        return view('PurchaseOrder.edit', compact('purchaseOrder', 'companies', 'departments', 'materialTypes','workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update($request->all());
        return redirect()->route('purchaseOrder.index')->with('success', 'Purchase Order Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchaseOrder.create')->with('success', 'Purchase Order Deleted Successfully');
    }



    public function filterShow(){
        $companies = Company::all();
        return view('PurchaseOrder.filter',compact('companies'));
    }
    public function filter(Request $request)
{
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $companyId = $request->input('company');

    $query = PurchaseOrder::query();

    if ($fromDate && $toDate) {
        $query->whereBetween('date', [$fromDate, $toDate]);
    }

    if ($companyId) {
        $query->where('company_id', $companyId);
    }

    $filteredOrders = $query->with('company')->get();

    return response()->json($filteredOrders);
}
public function getMaterialsByPoNumber(Request $request)
{
    $poNumber = $request->get('po_number');

    // Query the materials related to the given PO number
    $materials = Purcahsematerial::where('po_number_id', $poNumber)->get();

    return response()->json($materials);
}
public function showReport(Request $request)
{
    $poNumber = $request->get('po_number');

    // Fetch the purchase materials based on PO number
    $purchaseMaterials = Purcahsematerial::where('po_number_id', $poNumber)->get();

    // Use first() to fetch a single PurchaseOrder instance instead of a collection
    $purchaseOrder = PurchaseOrder::with('company','for')->where('po_number', $poNumber)->first();

    return view('PurchaseOrder.report', compact('purchaseMaterials', 'poNumber', 'purchaseOrder'));
}



}
