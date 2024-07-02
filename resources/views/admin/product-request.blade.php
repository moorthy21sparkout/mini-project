<x-admin-layout>

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <x-alert-error>
        {{ session('error') }}
    </x-alert-error>


    <div class="container mx-auto px-4">
        <div class="py-8">
            <h2 class="text-2xl font-bold mb-4">Product Requests</h2>

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
                                        Requested By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Emergency
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($productRequests as $productRequest)
                                    <tr class="{{ $productRequest->emergency ? 'bg-red-600' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $productRequest->product }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $productRequest->price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $productRequest->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $productRequest->emergency ? 'Yes' : 'No' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form
                                                action="{{ route('admin-product-request-approve', ['id' => $productRequest->id]) }}"
                                                method="post" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-green-500 text-white px-4 py-2">Approve</button>
                                            </form>

                                            <form
                                                action="{{ route('admin-product-request-reject', ['id' => $productRequest->id]) }}"
                                                method="post" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2">Reject</button>
                                            </form>
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
</x-admin-layout>
