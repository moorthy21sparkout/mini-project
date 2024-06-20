<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body>

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Task</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        {{-- <a href="{{ route('user_task.create') }}"
                            class="block py-2 px-3 text-gray-900 bg-white-500 hover:bg-green-700 text-white rounded md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            aria-current="page">Create new +
                        </a> --}}
                        <a href="{{ route('user_task.create') }}">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                create new
                            </button>
                        </a>

                    </li>
                    <li>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <a href="{{ route('user-notification') }}" class="text-white">Notification</a>
                        </button>
                        
                    <li>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <a href="{{ route('user-email') }}" class="text-white">E-mails</a>
                        </button>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">@csrf
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Log-out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="note-container">
        @forelse ($tasks as $task)
            <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-blue-800">
                            <a href="{{ route('user_task.show', $task) }}">{{ $task->task }}</a>
                        </h2>
                    </div>
                    @foreach ($task->titles as $title)
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="text-sm text-gray-800">
                                <a href="#">{{ $title->title }}</a>
                            </h4>
                        </div>
                        <p class="text-gray-700">{{ Str::limit($title->description, 150) }}</p>
                    @endforeach
                </div>
                <div class="px-6 py-2 mt-auto">
                    <p class="text-xs text-gray-500">{{ $task->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-lg text-yellow-600">No tasks found</p>
        @endforelse
    </div>





    </div>

</body>

</html>
