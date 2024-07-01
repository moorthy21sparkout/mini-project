<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomProductRequest;
use App\Models\CustomerProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\User;
use App\Notifications\ProductRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the products for the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all products and pass them to the add-product view
        $product = Product::all();
        return view('user.add-product', compact('product'));
    }

    /**
     * Store a newly created customer product in storage.
     *
     * @param  \App\Http\Requests\CustomProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomProductRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Create a new CustomerProduct instance
        $customerProduct = new CustomerProduct();
        $customerProduct->user_id = Auth::id();
        $customerProduct->customer_name = $validatedData['customer_name'];
        $customerProduct->customer_phonenumber = $validatedData['customer_phonenumber'];
        $customerProduct->ordered_products = json_encode($request->input('productlists'));
        $customerProduct->overall_total = $validatedData['overall_total'];

        // Save the customer product
        $customerProduct->save();

        // Redirect to the add-product route with a success message
        return redirect()->route('user-add')->with('success', 'Customer product added successfully.');
    }

    /**
     * Get the applicable discount for a given grand total.
     *
     * @param  float  $grandTotal
     * @return \Illuminate\Http\JsonResponse
     */
    public function discounts($grandTotal)
    {
        // Find the discount that applies to the grand total
        $discount = Discount::where('price', '<=', $grandTotal)->orderBy('price', 'desc')->first();

        // Set discount value to 0 if no discount found
        if (!$discount) {
            $discountValue = 0;
        } else {
            $discountValue = $discount->discount;
        }

        // Return the discount value as JSON
        return response()->json(['discount' => $discountValue]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProductForm()
    {
        // Return the view to display the form for adding a product
        return view('user.create-product');
    }

    /**
     * Add a new product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
        ]);

        // Create a new ProductRequest instance
        $product = new ProductRequest();
        $product->product = $validatedData['product_name'];
        $product->price = $validatedData['product_price'];

       
        $product->save();

       
        return redirect()->route('add-product')->with('success', 'Product added successfully.');
    }

    /**
     * Display a listing of the customer products for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // Fetch customer products for the authenticated user, ordered by creation date
        $customerProducts = CustomerProduct::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // Return the customer products view with the fetched products
        return view('user.customer', compact('customerProducts'));
    }

    /**
     * Show the form for submitting a product request.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProductRequestForm()
    {
        // Return the view to display the form for creating a product request
        return view('user.create-product');
    }

    /**
     * Handle the submission of a product request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleProductRequest(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
        ]);

       
        $productRequest = new ProductRequest();
        $productRequest->user_id = Auth::id();
        $productRequest->product = $validatedData['product_name'];
        $productRequest->price = $validatedData['product_price'];
        $productRequest->save();

        // Notify  admin users about the new product request
        $adminUsers = User::where('usertype', 'admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new ProductRequestNotification($productRequest));
        }

      
        return redirect()->back()->with('success', 'Product request submitted successfully.');
    }
}
