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
        // Fetch all products and pass them to the product index view
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
        // Return the view for creating a new product
        return view('admin.product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomProductRequest $request)
    {
        // Validate the request and create a new product
        $product = $request->validated();
        Product::create($product);

        // Redirect to the product index page with a success message
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
        // Find the product by ID and pass it to the edit view
        $product = Product::find($id);
        return view('admin.admin-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomProductRequest $request, $id)
    {
        // Find the product by ID, validate the request, and update the product
        $getProduct = Product::find($id);
        $product = $request->validated();
        $getProduct->update($product);

        // Redirect to the product index page with a success message
        return redirect()->route('admin.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the product by ID and delete it
        $product = Product::find($id);
        $product->delete();

        // Redirect to the product index page with a success message
        return redirect()->route('admin.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * List all product requests.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listProductRequests($id)
    {
        // Fetch all product requests and pass them to the product request view
        $productRequests = ProductRequest::all();
        return view('admin.product-request', compact('productRequests'));
    }

    /**
     * Approve a product request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveProductRequest($id)
    {
        // Find the product request by ID
        $productRequest = ProductRequest::find($id);
        $productRequest->status = 'approved';
        if (!$productRequest) {
            // If the product request is not found, return the view with an error message
            return view('admin.product-request', ['productRequests' => ProductRequest::all()])
                ->with('error', 'Product request not found.');
        }

        // Create a new Product instance from the product request
        $product = new Product();
        $product->product = $productRequest->product;
        $product->price = $productRequest->price;
        $product->save();

        // Delete the product request after approval
        $productRequest->delete();

        // Return the view with a success message
        return view('admin.product-request', ['productRequests' => ProductRequest::all()])
            ->with('success', 'Product request approved and added successfully.');
    }

    /**
     * Reject a product request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectProductRequest($id)
    {
        // Find the product request by ID
        $productRequest = ProductRequest::find($id);
        $productRequest->status = 'Rejected';

        if (!$productRequest) {
            // If the product request is not found, return the view with an error message
            return view('admin.product-request', ['productRequests' => ProductRequest::all()])
                ->with('error', 'Product request not found.');
        }

        // Delete the product request after rejection
        $productRequest->delete();

        // Return the view with a success message
        return view('admin.product-request', ['productRequests' => ProductRequest::all()])
            ->with('success', 'Product request rejected and removed successfully.');
    }
}
