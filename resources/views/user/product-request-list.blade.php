<x-user-layout>

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <x-alert-error>
        {{ session('error') }}
    </x-alert-error>

    <div class="container mx-auto px-4">
        <div class="py-8">
            <h2 class="text-2xl font-bold mb-4">Your Product Requests</h2>

            @isset($productRequests)
                @if ($productRequests->isEmpty())
                    <p>No product requests found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productRequests as $productRequest)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $productRequest->product }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $productRequest->price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $productRequest->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endisset
        </div>
    </div>

</x-user-layout>
