<!-- resources/views/products/show.blade.php -->

<x-admin-layout>
    <div class="container mx-auto px-4">
        <div class="py-8">
            <h2 class="text-2xl font-bold mb-4">Product Details</h2>

            <div class="bg-white shadow-md rounded p-4 mb-4">
                <p><strong>ID:</strong> {{ $product->id }}</p>
                <p><strong>Name:</strong> {{ $product->product }}</p>
                <p><strong>Price:</strong> ${{ $product->price }}</p>
                <p><strong>Created At:</strong> {{ $product->created_at->format('Y-m-d H:i:s') }}</p>
                <!-- Add more details as needed -->
            </div>

            <h2 class="text-2xl font-bold mb-4">Product Requests</h2>

            @if ($productRequests->count() > 0)
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($productRequests as $request)
                        <div class="bg-white shadow-md rounded p-4 mb-4">
                            <p><strong>ID:</strong> {{ $request->id }}</p>
                            <p><strong>User:</strong> {{ $request->user->name }}</p>
                            <p><strong>Product Name:</strong> {{ $request->product_name }}</p>
                            <p><strong>Product Price:</strong> ${{ $request->product_price }}</p>
                            <p><strong>Requested At:</strong> {{ $request->created_at->format('Y-m-d H:i:s') }}</p>
                            <!-- Add more details as needed -->
                        </div>
                    @endforeach
                </div>
            @else
                <p>No product requests found.</p>
            @endif
        </div>
    </div>
</x-admin-layout>
