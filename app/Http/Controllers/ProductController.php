<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=Product::all();
        return view('admin.product-index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       $product= $request->validate([
            'product' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($product);

        return redirect()->route('admin.index')->with('success', 'Product created successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view ('admin.admin-edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $getProduct=Product::find($id);
        $product= $request->validate([
            'product' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

       $getProduct->update($product);

        return redirect()->route('admin.index')->with('success', 'Product Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);   
        $product->delete();
        return redirect()->route('admin.index')->with('success', 'Product deteted successfully.');

    }
}
