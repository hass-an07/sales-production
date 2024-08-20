<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        // Build the query with relationships and search conditions
        $company = Company::when($keyword, function ($query) use ($keyword) {
                $query->where('company_name', 'like', '%' . $keyword . '%')  // Search by invoice number
                    ->orWhere('owner_name', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('Company.list', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $company = new Company();
        $company->company_name = $request->company_name;
        $company->owner_name = $request->owner_name;
        $company->address = $request->address;
        $company->save();

        return redirect()->route('company.index')->with('success', 'Company Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // dd($company); // This will dump and die the company instance.
        return view('Company.edit', compact('company'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // $company = Company::find
        $company->company_name = $request->company_name;
        $company->owner_name = $request->owner_name;
        $company->address = $request->address;
        $company->update();

        return redirect()->route('company.index')->with('success', 'Company Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Company Deleted Successfully');
    }
}
