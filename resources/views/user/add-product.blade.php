<x-user-layout>
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    <form action="{{ route('user-store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="container mx-auto">
            <div class="p-8 bg-white min-h-screen shadow-md rounded-lg">
                <div class="mb-4">
                    <label for="customer_name" class="block">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name"
                        class="form-input mt-1 block border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Enter customer name" required>
                    @error('customer_name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block">Phone Number</label>
                    <input type="text" id="phone_number" name="customer_phonenumber"
                        class="form-input mt-1 block border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Enter phone number" required>
                    @error('customer_phonenumber')
                        <p class="text-red-500 ">{{ $message }}</p>
                    @enderror
                </div>
                <div id="addProductForm" class="space-y-4">
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-col sm:flex-row sm:space-x-2">
                            <div class="mb-4">
                                <label for="product_id" class="block">Select Product</label>
                                <select id="product_id" name="product_id"
                                    class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                                    <option value="">Select a product</option>
                                    @foreach ($product as $product)
                                        <option value="{{ $product->id }}" data-name="{{ $product->product }}"
                                            data-price="{{ $product->price }}">
                                            {{ $product->product }}
                                        </option>
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
                                    placeholder="Enter quantity" value="1">
                            </div>
                            <div class="flex flex-col sm:flex-row sm:space-x-2">
                                <div class="mb-4">
                                    <label for="total" class="block">Total</label>
                                    <input type="number" id="total" name="item_total"
                                        class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50"
                                        placeholder="Total" readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block">&nbsp;</label>
                                    <button type="button"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="addProduct()">
                                        <i class="fa fa-plus-circle"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="container mx-auto">
                    <div class="p-8 bg-white shadow-md rounded-lg">

                        <div class="mt-8 flex justify-end items-center">
                            <h3 class="font-bold mb-4 mr-4">Current Total</h3>
                            <input type="number" id="currectTotal" name="currentTotal" readonly
                                class="form-input w-32 border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        </div>

                        <div class="mt-8 flex justify-end items-center">
                            <div class="mr-4">
                                <label for="discount" class="block font-bold">Discount (%)</label>
                                <input type="number" id="discount" name="discount" readonly
                                    class="form-input w-24 border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="gst" class="block font-bold">GST (%)</label>
                                <input type="number" id="gst" name="gst" value="5" readonly
                                    class="form-input w-24 border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end items-center">
                            <h3 class="font-bold mb-4 mr-4">Final Total</h3>
                            <input type="number" id="finalTotal" name="overall_total" readonly
                                class="form-input w-32 border-gray-300 rounded-md shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="productlists" id="product-list-items">

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" id="grandTotal" name="grandTotal">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let productItems = []
            document.getElementById("product-list-items").value = JSON.stringify(productItems)

            $('#product_id').change(function() {
                var selectedOption = $('option:selected', this);
                var productName = selectedOption.data('name');
                var productPrice = selectedOption.data('price');

                $('#price').val(productPrice);
                calculateTotal();
            });

            $('#quantity').on('input', function() {
                calculateTotal();
            });

            $('#discount').on('input', function() {
                calculateFinalTotal();
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

            function addProduct(productId, productName, productPrice, quantity, total, currentTotal) {
                var existingProduct = productItems.find(function(item) {
                    return item.productId === productId;
                });
                var total = productPrice * quantity;
                if (existingProduct) {
                    existingProduct.quantity = parseInt(existingProduct.quantity) + parseInt(quantity);
                    existingProduct.total = parseInt(existingProduct.quantity) * productPrice;
                } else {
                    productItems.push({
                        productId: productId,
                        productName: productName,
                        productPrice: productPrice,
                        quantity: quantity,
                        total: total,
                        currentTotal: currentTotal
                    });

                    const element = document.getElementById("product-list-items");
                    element.setAttribute("value", JSON.stringify(productItems));
                }
                renderProductItems();
                return productItems;
            }

            window.removeProductItems = function(productId) {
                productItems = productItems.filter(function(item) {
                    return item.productId !== productId;
                });
                renderProductItems();
                updateGrandTotal();
            }

            function renderProductItems() {
                $('#productItems').empty();

                productItems.forEach(function(item) {
                    var row = `<tr>                                                                                                                                                                                                                                                                                 
                        <td  class="px-6 py-4 whitespace-nowrap">${item.productName}</td>                                                                                                                                                                                                                                                                                   
                        <td  class="px-6 py-4 whitespace-nowrap">${item.productPrice.toFixed(2)}</td>                                                                                                                                                                                                                                                                                   
                        <td  class="px-6 py-4 whitespace-nowrap">${item.quantity}</td>                                                                                                                                                                                                                                                                                  
                        <td  class="px-6 py-4 whitespace-nowrap">${item.total.toFixed(2)}</td>
                        <td  class="px-6 py-4 whitespace-nowrap"><button type="button" class="text-red-600 hover:text-red-900" onclick="removeProductItems('${item.productId}')">Remove</button></td>
                    </tr>`;
                    $('#productItems').append(row);
                });

                updateGrandTotal();
            }

            window.addProduct = function() {
                var productId = $('#product_id').val();
                var productName = $('#product_id option:selected').data('name');
                var productPrice = $('#product_id option:selected').data('price');
                var quantity = $('#quantity').val();
                var total = productPrice * quantity;

                if (productId && productName && productPrice && quantity && total) {
                    addProduct(productId, productName, productPrice, quantity);
                    renderProductItems();
                    reset();
                }

            }

            function updateGrandTotal() {
                var grandTotal = productItems.reduce((sum, item) => sum + item.total, 0);

                $.ajax({
                    url: `/discount/${grandTotal}`,
                    type: 'GET',
                    success: function(data) {
                        // console.log(data);
                        $('#discount').val(data
                            .discount);
                        calculateFinalTotal();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });


                $('#grandTotal').val(grandTotal.toFixed(2));
                calculateFinalTotal();
            }

            function calculateFinalTotal() {
                var grandTotal = parseFloat($('#grandTotal').val());
                console.log('the grand total:', grandTotal);
                var discount = parseFloat($('#discount').val());
                if (isNaN(discount)) {
                    discount = 0;
                }
                var gstRate = 0.05; // GST rate in percentage
                var finalTotal = grandTotal;
                var gstAmount = (grandTotal * gstRate);
                console.log("GST Amount:", gstAmount);
                var grandTotal = grandTotal + gstAmount;
                console.log("Grand Total with GST:", grandTotal);
                
                console.log('Grand Total with GST:', grandTotal);
                
                $('#currectTotal').val(finalTotal.toFixed(2));
                var finalTotal = grandTotal - (grandTotal * (discount / 100));
                console.log("Final Total:", finalTotal);

                $('#finalTotal').val(finalTotal.toFixed(2));
            }

            function reset() {
                $('#product_id').val('');
                $('#price').val('');
                $('#quantity').val('');
                $('#total').val('');
            }
        });
    </script>
</x-user-layout>
