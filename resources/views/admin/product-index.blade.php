<x-admin-layout>
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <a href="{{ route('admin.create') }}">Create</a>
            </button>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->product }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">₹ {{ $product->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{route('admin.edit',$product->id)}}"
                                class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                            <form action="{{route('admin.destroy',$product->id)}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
