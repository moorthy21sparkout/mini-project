<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="https://flowbite.com/docs/images/logo.svg" alt="Flowbite Logo">
                    <span class="ml-2 text-lg font-bold text-gray-800">Admin Dashboard</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Users</a>
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Settings</a>
                        <a href="{{ route('logout') }}"
                            class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md text-sm font-medium"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed. -->
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        <!-- Icon when menu is open. -->
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu, show/hide based on menu state. -->
        <!-- Menu open: "block", Menu closed: "hidden" -->
        <div class="md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-800">Dashboard</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-800">Users</a>
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-800">Settings</a>
                <form action="{{ route('logout') }}" method="post">@csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Log-out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Task List</h1>
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
        <div class="w-full overflow-x-auto">
            <table class="w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b border-gray-300">S.No</th>
                        <th class="py-2 px-4 border-b border-gray-300">Task</th>
                        <th class="py-2 px-4 border-b border-gray-300">Title</th>
                        <th class="py-2 px-4 border-b border-gray-300">Description</th>
                        <th class="py-2 px-4 border-b border-gray-300">Due Date</th>
                        <th class="py-2 px-4 border-b border-gray-300">Attachment</th>
                        <th class="py-2 px-4 border-b border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $index => $task)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $task->task }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $task->title }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $task->description }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $task->due_date }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                @if ($task->attachment)
                                    <a href="{{ asset('storage/' . $task->attachment) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Download</a>
                                @else
                                    No Attachment
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b border-gray-300 flex justify-center space-x-2">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <a href="#">Update</a>
                                </button>

                                <button
                                    class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Submit
                                </button>
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>
