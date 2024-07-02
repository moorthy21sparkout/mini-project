<x-user-layout>
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    <form action="{{ route('user-product-request') }}" method="post">
        @csrf
        <div class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                <input type="text" id="product" name="product_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter the product" required />
                @error('product_name')
                    <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Price</label>
                <input type="number" id="price" name="product_price" min="1"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="enter the price" required />
                @error('product_price')
                    <p class="text-red-500 ">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="emergency"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emergency</label>
                <input type="checkbox" id="emergency" name="emergency"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </form>

</x-user-layout>
