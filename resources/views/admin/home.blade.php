<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-gray-800">
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <span class="text-blue-500 font-bold uppercase">Admin Dashboard</span>
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-gray-800">
                    <a href="" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        E-mail
                    </a>
                    <a href="{{ route('admin.notifications') }}"
                        class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Notification
                    </a>
                    <a href="{{ route('admin-create') }}"
                        class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Create & Asign
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">

                    <input class="mx-4 w-full border rounded-md px-4 py-2" type="text" placeholder="Search">
                </div>
                <div class="flex items-center pr-4">
                    <form action="{{ route('logout') }}" method="post">@csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Log-out
                        </button>
                    </form>
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="note-container">
                @forelse ($tasks as $task)
                    <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between mb-2">
                                <h2 class="text-lg font-semibold text-gray-200">
                                    <a href="{{ route('admin-show', ['id' => $task->id]) }}"
                                        class="text-gray-700 hover:text-blue-600">
                                        <strong>Task:</strong> {{ $task->task }}
                                    </a>
                                </h2>
                            </div>
                            @foreach ($task->titles as $title)
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm text-gray-800">
                                        <a href="#">{{ $title->title }}</a>
                                    </h4>
                                </div>
                                <p class="text-gray-700">{{ Str::limit($title->description, 20) }}</p>
                            @endforeach
                        </div>
                        <div class="px-6 py-2 mt-auto">
                            <p class="text-xs text-gray-500">{{ $task->updated_at->diffForHumans() }}</p>
                        </div>
                        @foreach ($task->titles as $title)
                            <div class="px-6 py-2 mt-auto">
                                <p class="text-xs text-gray-500">Status:{{ $title->status }}</p>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-lg text-yellow-600">No tasks found</p>
                @endforelse
            </div>

        </div>

</body>

</html>
{{-- <tbody>
    @foreach ($tasks as $index => $task)
        @foreach ($task->titles as $title)
            <tr>
                <td class="py-2 px-4 border-b border-gray-300">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b border-gray-300">{{ $task->task }}</td>
                <td class="py-2 px-4 border-b border-gray-300">{{ $title->title }}</td>
                <td class="py-2 px-4 border-b border-gray-300">{{ $title->description }}
                </td>
                <td class="py-2 px-4 border-b border-gray-300">{{ $title->due_date }}</td>
                <td class="py-2 px-4 border-b border-gray-300">
                    @if ($title->attachment)
                        <a href="{{ asset('storage/' . $title->attachment) }}"
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
    @endforeach
</tbody> --}}
