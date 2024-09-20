<?php

namespace App\Http\Controllers;

use App\Models\Expenseregistration;
use App\Http\Requests\StoreExpenseregistrationRequest;
use App\Http\Requests\UpdateExpenseregistrationRequest;
use Illuminate\Support\Facades\Validator;

class ExpenseregistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registerExpenses = Expenseregistration::paginate(10);
        return view('Expenseregistration.list',compact('registerExpenses'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ExpenseRegistration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseregistrationRequest $request)
    {
        $valiadtor = Validator::make($request->all(),[
            'ex_code' => 'required',
            'ex_name' => 'required',
            'status' => 'required',
        ]);
        if($valiadtor->fails()){
            return redirect()->back()->withErrors($valiadtor)->withInput();
        }
        Expenseregistration::create($request->all());
        return redirect()->route('registerExpense.index')->with('success','Expenseregistration created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenseregistration $expenseregistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenseregistration $expenseregistration)
    {
        dd($expenseregistration);
    }
    
    public function editRegisterExpense($id){
        $expenseregistration = Expenseregistration::find($id);
        return view('ExpenseRegistration.edit',compact('expenseregistration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseregistrationRequest $request, Expenseregistration $expenseregistration)
    {
        $validator = Validator::make($request->all(), [
            'ex_code' => 'required',
            'ex_name' => 'required',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Updating the specific instance of Expenseregistration
        $expenseregistration->update($request->all());
    
        return redirect()->route('registerExpense.index')->with('success', 'Expenseregistration updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenseregistration $expenseregistration)
    {
        $expenseregistration->delete();
        return redirect()->route('registerExpense.index')->with('success','Expenseregistration deleted successfully');
    }
}
