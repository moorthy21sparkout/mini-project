<x-user-layout>
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border border-gray-200">Receipt No</th>
                <th class="px-4 py-2 border border-gray-200">Customer Name</th>
                <th class="px-4 py-2 border border-gray-200">Customer Phone Number</th>
                <th class="px-4 py-2 border border-gray-200">Ordered Products</th>
                <th class="px-4 py-2 border border-gray-200">Overall Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customerProducts as $customerProduct)
                <tr>
                    <td class="px-4 py-2 border border-gray-200">{{ $customerProduct->receipt_no }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $customerProduct->customer_name }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $customerProduct->customer_phonenumber }}</td>
                    <td class="px-4 py-2 border border-gray-200">
                        <ul>
                            @php
                                $orderedProducts = json_decode($customerProduct->ordered_products, true);
                                $product = json_decode($orderedProducts);
                            @endphp
                            @foreach ($product as $orderedProduct)
                                <li>
                                    <span class="font-semibold">Product Name:</span>
                                    {{ $orderedProduct->productName }},<br>
                                    <span class="font-semibold">Product Price:</span>
                                    {{ $orderedProduct->productPrice }},<br>
                                    <span class="font-semibold">Quantity:</span> {{ $orderedProduct->quantity }},<br>
                                    <span class="font-semibold">Total:</span> {{ $orderedProduct->total }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="px-4 py-2 border border-gray-200">{{ $customerProduct->overall_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-user-layout>
