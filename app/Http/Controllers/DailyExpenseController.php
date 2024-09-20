<?php

namespace App\Http\Controllers;

use App\Models\DailyExpense;
use App\Http\Requests\StoreDailyExpenseRequest;
use App\Http\Requests\UpdateDailyExpenseRequest;
use App\Models\Expenseregistration;
use Illuminate\Http\Request;

class DailyExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dailyExpenses = DailyExpense::all();
        $total = $dailyExpenses->sum('amount');
        return view('DailyExpense.list', compact('dailyExpenses', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dailyExpenses = Expenseregistration::all();
        return view('DailyExpense.create', compact('dailyExpenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyExpenseRequest $request)
    {
        $request->validate([
            'date' => 'required|date',
            'ex_code' => 'required|string|max:255',
            'ex_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        // Create a new record in the database
        DailyExpense::create([
            'date' => $request->input('date'),
            'ex_code' => $request->input('ex_code'),
            'ex_name' => $request->input('ex_name'),
            'amount' => $request->input('amount'),
        ]);

        // Redirect back to the index with a success message
        return redirect()->route('dailyExpense.index')->with('success', 'Expense registration created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyExpense $dailyExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyExpense $dailyExpense)
    {
        $expenseCodes  = DailyExpense::all();
        return view('DailyExpense.edit', compact('dailyExpense', 'expenseCodes'));
    }

    // public function editDailyExpense($id){
    //     $dailyExpense = DailyExpense::find($id);
    //     return view('DailyExpense.edit',compact('dailyExpense'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyExpenseRequest $request, DailyExpense $dailyExpense)
    {
        $request->validate([
            'date' => 'required|date',
            'ex_code' => 'required|string|max:255',
            'ex_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        // Create a new record in the database
        $dailyExpense->update($request->all());

        // Redirect back to the index with a success message
        return redirect()->route('dailyExpense.index')->with('success', 'Expense registration Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyExpense $dailyExpense)
    {
        $dailyExpense->delete();
        return redirect()->route('dailyExpense.index')->with('success', 'Daily Expense delete successfully');
    }
    public function getExpenseName($ex_code)
    {
        $expense = Expenseregistration::where('ex_code', $ex_code)->first();
        if ($expense) {
            return response()->json(['ex_name' => $expense->ex_name]);
        } else {
            return response()->json(['ex_name' => '']);
        }
    }

    public function filterShow(){
        return view('DailyExpense.filter');
    }

    public function filterExpense(Request $request)
{
    $fromDate = $request->from_date;
    $toDate = $request->to_date;

    $receivedProducts = DailyExpense::whereDate('date', '>=', $fromDate)
                                        ->whereDate('date', '<=', $toDate)
                                        ->get();

    return response()->json($receivedProducts);
}
}
