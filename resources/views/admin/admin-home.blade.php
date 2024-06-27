<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="{{ route('admin-assignTask') }}"
                        class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Assign
                    </a>
                    <a href="{{ route('admin-create') }}"
                        class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Create
                    </a>
                    <a href="{{ route('user_task.index') }}"
                        class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Your Task
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">

                    <strong class="text-blue-400">All User's Task List</strong>
                    <form id="searchForm" class="ml-4">
                        <input type="text" id="search" class="bg-gray-100 p-2 rounded border"
                            placeholder="Search tasks">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Search
                        </button>
                    </form>
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

            <!-- Display Success Message -->
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3" id="note-container">
                @forelse ($tasks as $task)
                    <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between mb-2 ">
                                <h2 class="text-lg font-semibold text-blue-800 hover:underline ">
                                    <a href="{{ route('admin-show', ['id' => $task->id]) }}"
                                        class="text-lg font-semibold text-blue-500 flex gap-2">
                                        Task:
                                        <pre>{{ $task->task }}</pre>
                                    </a>
                                </h2>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-lg font-semibold text-gray-600">
                                    User: {{ $task->user->name }}
                                </h4>
                            </div>
                            @foreach ($task->titles as $title)
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm text-gray-800">
                                        <a href="#"><span class="text-gray-900">Titles:
                                            </span>{{ $title->title }}</a>
                                    </h4>
                                </div>
                                <p class="text-gray-700"><span class="text-red-800">Description:
                                    </span>{{ Str::limit($title->description, 20) }}
                                </p>


                                <div class="px-6 py-2 mt-auto">
                                    <p class="text-xs text-gray-500">{{ $task->updated_at->diffForHumans() }}</p>
                                </div>

                                <div class="px-6 py-2 mt-auto">
                                    <p class="text-xs text-gray-500">Status:{{ $title->status }}</p>
                                </div>
                            @endforeach

                        </div>

                    </div>
                @empty
                    <p class="text-lg text-yellow-600">No tasks found</p>
                @endforelse

            </div>
            <!-- Pagination Links -->
            <div class=" px-4 py-6 flex items-center justify-between border-t border-gray-200 sm:px-6">
                {{ $tasks->links() }}
            </div>
            <h4 id="Content"></h4>
        </div>

        <script>
            // CSRF token setup for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var $noteContainer = $('#note-container');
            $('#search').on('keyup', function() {
                // alert('working done');
                $value = $(this).val();
                $.ajax({
                    type: 'post',
                    url: '{{ route('search-filter') }}',
                    data: {
                        'search': $value
                    },

                    success: function(data) {
                        let result = '';
                        data.forEach(tasks => {
                            result += `<div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between mb-2 ">
                                    <h2 class="text-lg font-semibold text-blue-800 hover:underline ">
                                        <a href="{{ route('admin-show', ['id' => $task->id]) }}"
                                            class="text-lg font-semibold text-blue-500 flex gap-2">
                                            Task:
                                            <pre>' ${tasks.task} '</pre>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>`;
                        });

                        $noteContainer.html(result);
                    }
                });




            })
        </script>
</body>

</html>
