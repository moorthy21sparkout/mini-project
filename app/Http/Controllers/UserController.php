<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerProductRequest;
use App\Models\CustomerProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\User;
use App\Notifications\ProductRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('user.add-product', compact('products'));
    }

    public function store(CreateCustomerProductRequest $request)
    {
        $validatedData = $request->validated();

        $customerProduct = new CustomerProduct();

        $customerProduct->user_id = Auth::id();
        $customerProduct->customer_name = $validatedData['customer_name'];
        $customerProduct->customer_phonenumber = $validatedData['customer_phonenumber'];
        $customerProduct->ordered_products = json_encode($request->input('productlists'));
        $customerProduct->overall_total = $validatedData['overall_total'];

        $customerProduct->save();

        return redirect()->route('user-add')->with('success', 'Customer product added successfully.');
    }

    public function discounts($grandTotal)
    {
        $discount = Discount::where('price', '<=', $grandTotal)->orderBy('price', 'desc')->first();

        if (!$discount) {
            $discountValue = 0;
        } else {
            $discountValue = $discount->discount;
        }

        return response()->json(['discount' => $discountValue]);
    }

    public function list()
    {
        $customerProducts = CustomerProduct::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('user.customer', compact('customerProducts'));
    }

    public function showProductRequestForm()
    {
        return view('user.create-product');
    }

    public function handleProductRequest(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
        ]);

        $productRequest = new ProductRequest();
        $productRequest->user_id = Auth::id();
        $productRequest->product_name = $validatedData['product_name'];
        $productRequest->product_price = $validatedData['product_price'];
        $productRequest->save();

        $adminUsers = User::where('usertype', 'admin')->get();
        foreach ($adminUsers as $adminUser) {
            $adminUser->notify(new ProductRequestNotification($productRequest));
        }

        return redirect()->back()->with('success', 'Product request submitted successfully.');
    }
}
