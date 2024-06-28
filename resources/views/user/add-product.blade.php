<x-user-layout>
    <form action="{{route('user-store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container mx-auto">
            <div class="p-8 bg-white min-h-screen shadow-md rounded-lg">
                <div class="mb-4">
                    <label for="customer_name" class="block">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name"
                        class="form-input mt-1 block  border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Enter customer name" required>
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number"
                        class="form-input mt-1 block  border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Enter phone number" required>
                </div>
                <form id="addProductForm" class="space-y-4">
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-col sm:flex-row sm:space-x-2">
                            <div class="mb-4">
                                <label for="product_id" class="block">Select Product</label>
                                <select id="product_id" name="product_id"
                                    class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    required>
                                    <option value="">Select a product</option>
                                    @foreach ($product as $product)
                                        <option value="{{ $product->id }}" data-amount="{{ $product->price }}">
                                            {{ $product->product }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block">Price</label>
                                <input type="number" id="price" name="price"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    placeholder="Price" required readonly>
                            </div>
                            <div class="mb-4">
                                <label for="quantity" class="block">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1"
                                    class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                    placeholder="Enter quantity" required>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:space-x-2">
                                <div class="mb-4">
                                    <label for="total" class="block">Total</label>
                                    <input type="number" id="total" name="total"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50"
                                        placeholder="Total" readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block">&nbsp;</label>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="fa fa-plus-circle"></i>Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="productList" class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Product List</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Remove</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="productItems">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <h3 class=" font-bold mb-4">Total</h3>
                    <input type="number" id="grandTotal" name="grandTotal" readonly
                        class="form-input mt-1 block  border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_id').change(function() {
                var ProductPrice = $('option:selected', this).data('amount');
                $('#price').val(ProductPrice);
                calculateTotal();
            });

            $('#quantity').on('input', function() {
                calculateTotal();
            });

            function calculateTotal() {
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                if (!isNaN(price) && !isNaN(quantity)) {
                    var total = price * quantity;
                    $('#total').val(total.toFixed(2));
                } else {
                    $('#total').val('');
                }
            }

            $('#addProductForm').submit(function(event) {
                event.preventDefault();

                var productId = $('#product_id').val();
                var productName = $('#product_id option:selected').text();
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                var total = $('#total').val();

                if (productId && price && quantity && total) {
                    var productItem = `
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">${productName}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${price}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${quantity}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${total}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" class="text-red-600 hover:text-red-900" onclick="removeProduct(this)">Remove</button>
                            </td>
                        </tr>
                    `;
                    $('#productItems').append(productItem);
                    updateGrandTotal(parseFloat(total));
                    reset();
                }
            });

            function updateGrandTotal(productTotal) {
                var currentGrandTotal = parseFloat($('#grandTotal').val());
                if (isNaN(currentGrandTotal)) {
                    currentGrandTotal = 0;
                }
                var newGrandTotal = currentGrandTotal + productTotal;
                $('#grandTotal').val(newGrandTotal.toFixed(2));
            }

            function reset() {
                $('#product_id').val('');
                $('#price').val('');
                $('#quantity').val('');
                $('#total').val('');
            }

            function removeProduct(button) {
                $(button).closest('tr').remove();
                var totalToRemove = parseFloat($(button).closest('tr').find('td:nth-child(4)').text());
                var currentGrandTotal = parseFloat($('#grandTotal').val());
                if (!isNaN(currentGrandTotal)) {
                    var newGrandTotal = currentGrandTotal - totalToRemove;
                    $('#grandTotal').val(newGrandTotal.toFixed(2));
                }
            }
        });
    </script>
</x-user-layout>
