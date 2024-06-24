<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Notifications') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Notifications</h2>

                    @forelse ($notifications as $notification)
                        <div class="bg-white dark:bg-gray-700 shadow-md rounded-md mb-4 p-4">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $notification->data['message'] }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">No notifications found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
