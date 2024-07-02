<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-500 text-white min-h-screen p-4">
            <h2 class="text-2xl font-bold mb-6 text-center">user Panel</h2>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('customer-list') }}"
                            class="block py-2 px-4 rounded hover:bg-gray-700">Customer List</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('user-add') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Product</a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('add-product') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Add
                            Product</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{route('user.product-request-list')}}" class="block py-2 px-4 rounded hover:bg-gray-700">Request List</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700"> </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">
                </div>
                <div class="flex items-center pr-4">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Log-out
                        </button>
                    </form>
                </div>
            </div>
            <main>
                {{ $slot }}
            </main>
        </div>

    </div>
</body>

</html>
