<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $worker = Worker::with('department')->paginate(10);
    return view('Worker.Supplier.list', compact('worker'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('Worker.Supplier.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkerRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'dept_id' => 'required',
            'name' => 'required',
            'contact' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $worker = new Worker();
        $worker->dept_id = $request->dept_id;
        $worker->created_by = $request->created_by;
        $worker->worker_code = $request->worker_code;
        $worker->name = $request->name;
        $worker->reference = $request->reference;
        $worker->age = $request->age;
        $worker->cnic = $request->cnic;
        $worker->contact = $request->contact;
        $worker->address = $request->address;
        $worker->save();

        return redirect()->route('worker.index')->with('success','Worker/Supplier Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
{
    // Load the department relation for the given worker
    $worker->load('department');
    // dd($worker);

    // Get all departments
    $departments = Department::all();

    // Return the edit view with the worker and departments data
    return view('Worker.Supplier.edit', compact('worker', 'departments'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->dept_id = $request->dept_id;
        $worker->worker_code = $request->worker_code;
        $worker->name = $request->name;
        $worker->reference = $request->reference;
        $worker->age = $request->age;
        $worker->cnic = $request->cnic;
        $worker->contact = $request->contact;
        $worker->address = $request->address;
        $worker->update();

        return redirect()->route('worker.index')->with('success','worker Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->back()->with('success','Worker deleted successfully');
    }
}
