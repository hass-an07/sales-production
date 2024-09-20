<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // Ensure Carbon is imported at the top of your controller
use App\Models\Requisition;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\GrnItem;
use App\Models\Material;
use App\Models\MaterialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requisitions = Requisition::paginate(10);
        return view('requisition.list', compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $companies = Company::all();
        $mateialTypes = MaterialType::all();
        $materials = Material::all();
        $departments = Department::all();
        $currentTime = Carbon::now()->format('H:i'); // Get the current time in HH:MM format
        return view('requisition.create', compact('companies', 'currentTime', 'departments', 'mateialTypes', 'materials'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequisitionRequest $request)
    {
        // dd($request->all());
        // Validate the incoming request data
        // $request->validate([
        //     'date' => 'required',
        //     'time' => 'required',
        //     'company_id' => 'required',
        //     'requisition' => 'required|string|max:255',
        //     'status' => 'required|string|max:255',
        //     'store' => 'required|string|max:255',
        //     'dept_id' => 'required',
        //     'receiver' => 'required|string|max:255',
        //     'material_ty_id' => 'required|exists:material_types,id',
        //     'material' => 'required|string|max:255',
        //     'qty' => 'required|integer',
        //     'price' => 'required|numeric',
        //     'total' => 'required|numeric',
        //     'issue_for_id' => 'required',
        // ]);

        // Create the new requisition
        $requisition = Requisition::create([
            'created_by' => Auth::id(), // Assuming the user is logged in
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'company_id' => $request->input('company_id'),
            'requisition' => $request->input('requisition'),
            'status' => $request->input('status'),
            'store' => $request->input('store'),
            'dept_id' => $request->input('dept_id'),
            'receiver' => $request->input('reciver'),
            'material_ty_id' => $request->input('material_ty_id'),
            'material' => $request->input('material'),
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
            'total' => $request->input('total'),
            'issue_for_id' => $request->input('issue_for_id'),
        ]);

        // Redirect or return success response
        return redirect()->route('requisition.index')->with('success', 'Requisition created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Requisition $requisition) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisition $requisition)
    {
        $companies = Company::all();
        $departments = Department::all();
        $materials = Material::all();
        $mateialTypes = MaterialType::all();
        return view('Requisition.edit', compact('requisition', 'companies', 'departments', 'materials', 'mateialTypes'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequisitionRequest $request, Requisition $requisition)
    {
        $requisition->update([
            'created_by' => $requisition->created_by, // Usually, the original creator remains the same
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'company_id' => $request->input('company_id'),
            'requisition' => $request->input('requisition'),
            'status' => $request->input('status'),
            'store' => $request->input('store'),
            'dept_id' => $request->input('dept_id'),
            'receiver' => $request->input('reciver'),
            'material_ty_id' => $request->input('material_ty_id'),
            'material' => $request->input('material'),
            'qty' => $request->input('qty'),
            'price' => $request->input('price'),
            'total' => $request->input('total'),
            'issue_for_id' => $request->input('issue_for_id'),
        ]);

        return redirect()->route('requisition.index')->with('success', 'Requisition updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return redirect()->route('requisition.index')->with('success', 'Requisition deleted successfully.');
    }
    public function getMaterialPrice($material_name)
    {
        // Fetch the first item with the given material name
        $grnItem = GrnItem::where('material', $material_name)->first();

        if ($grnItem) {
            return response()->json(['price' => $grnItem->price]);
        } else {
            return response()->json(['price' => 0], 404); // Return 0 if the material is not found
        }
    }

    public function filterShow()
    {
        $companies = Company::all();
        return view('Requisition.filter', compact('companies'));
    }
    public function filter(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $companyId = $request->input('company');

        $query = Requisition::query();

        if ($fromDate && $toDate) {
            $query->whereBetween('date', [$fromDate, $toDate]);
        }

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        $filteredOrders = $query->with('company')->get();

        return response()->json($filteredOrders);
    }
    public function showReport($id)
    {
        // Fetch the GRN record by ID
        $requestion = Requisition::with('company','department')->find($id);
        $requestion_id = $requestion->id;

        $requestions = Requisition::where('id', $requestion_id)->get();

        if (!$requestion) {
            return redirect()->back()->with('error', 'GRN not found.');
        }

        // Return the view with GRN data and its items
        return view('Requisition.report', compact('requestion','requestions'));
    }
}
