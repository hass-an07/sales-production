<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Requisition;
use Illuminate\Http\Request;

class StoreReportController extends Controller
{
    public function filterShow(){
        $companies = Company::all();
        // $product_types = 
        // $stores =  $requesion->store;
        return view('storeReports.filter',compact('companies'));
    }
}