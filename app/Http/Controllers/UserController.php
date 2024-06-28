<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerProductRequest;
use App\Models\CustomerProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('user.add-product', compact('product'));
    }
    public function store(CreateCustomerProductRequest $request)
    {
        // Validation passed, create a new instance of CustomerProduct model
        $customerProduct = new CustomerProduct();

        // Assign values from validated request
        $customerProduct->user_id = $request->input('user_id');
        $customerProduct->receipt_no = $request->input('receipt_no');
        $customerProduct->date = $request->input('date');
        $customerProduct->customer_name = $request->input('customer_name');
        $customerProduct->customer_phonenumber = $request->input('customer_phonenumber');
        $customerProduct->product_name = $request->input('product_name');
        $customerProduct->price = $request->input('price');
        $customerProduct->quantity = $request->input('quantity');
        $customerProduct->item_total = $request->input('item_total');
        $customerProduct->overall_total = $request->input('overall_total');

        // Save the customer product
        $customerProduct->save();
        dd($customerProduct);

        // Redirect or return response as needed
        return redirect()->route('customer-products.index')->with('success', 'Customer product added successfully.');
    }
}
