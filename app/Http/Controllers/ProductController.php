<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomProductRequest;
use App\Models\Product;
use App\Models\ProductRequest;
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

        $products = Product::all();
        return view('admin.product-index', compact('products'));
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
    public function store(CustomProductRequest $request)
    {
        $product = $request->validated();

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
        $product = Product::find($id);
        return view('admin.admin-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomProductRequest $request, $id)
    {
        $getProduct = Product::find($id);
        $product = $request->validated();

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
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.index')->with('success', 'Product deteted successfully.');
    }
    public function listProductRequests()
    {
        $productRequests = ProductRequest::all();
        return view('admin.product-request', ['productRequests' => $productRequests]);
    }

    public function approveProductRequest($id)
    {
        $productRequest = ProductRequest::find($id);

        if (!$productRequest) {
            return redirect()->route('admin-product-requests')->with('error', 'Product request not found.');
        }

        // Create a new Product instance
        $product = new Product();
        $product->product = $productRequest->product_name;
        $product->price = $productRequest->product_price;
        $product->save();

        // Delete the product request after approval
        $productRequest->delete();

        return redirect()->route('admin-product-requests')->with('success', 'Product request approved and added successfully.');
    }

    public function rejectProductRequest($id)
    {
        $productRequest = ProductRequest::find($id);

        if (!$productRequest) {
            return redirect()->route('admin-product-requests')->with('error', 'Product request not found.');
        }

        // Delete the product request after rejection
        $productRequest->delete();

        return redirect()->route('admin-product-requests')->with('success', 'Product request rejected and removed successfully.');
    }
}
