<x-admin-layout>
    <div class="container mx-auto px-4">
        <div class="py-8">
            <h2 class="text-2xl font-bold mb-4">Product List</h2>

            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-200">Product Name</th>
                        <th class="px-4 py-2 border border-gray-200">Product Price</th>
                        <th class="px-4 py-2 border border-gray-200">Quantity</th>
                        <th class="px-4 py-2 border border-gray-200">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="px-4 py-2 border border-gray-200">{{ $product->productName }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $product->productPrice }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $product->quantity }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ $product->total }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
