<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Panel</h2>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="/home" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.index') }}"
                            class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.product.requests') }}"
                            class="block py-2 px-4 rounded hover:bg-gray-700">Approval for Products</a>
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
