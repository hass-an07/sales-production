<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $products = Product::when($keyword, function ($query) use ($keyword) {
                $query->where('product_code', 'like', '%' . $keyword . '%')  // Search by product code
                    ->orWhere('name', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
        return view('Product.list', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->product_code = $request->product_code;
        $product->name = $request->name;
        $product->size = $request->size;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->status = $request->status	;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('Product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
    }

    public function print(){
        $products = Product::all();
        return view('Product.Print',compact('products'));
    }
}
