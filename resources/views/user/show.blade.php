<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            @foreach ($userTasks as $task)
                @foreach ($task->titles as $title)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-gray-600">
                                <strong>Created: </strong>{{ $title->created_at->diffForHumans() }}
                            </p>
                            <p class="text-gray-600 ml-4">
                                <strong>Updated: </strong>{{ $title->updated_at->diffForHumans() }}
                            </p>
                            @if ($task->user_id == Auth::id())
                                <div class="flex justify-end mt-4">
                                    <!-- Use flex utility to justify buttons to the end -->
                                    <a href="{{ route('user_task.index') }}"
                                        class="btn-link btn-lg bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded mr-2">
                                        Back to Home
                                    </a>
                                    <a href="{{ route('user_task.edit', $task) }}"
                                        class="btn-link btn-lg bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">
                                        Edit
                                    </a>


                                    <form action="#" method="POST" class="ml-4">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="btn-link btn-lg bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure you want to delete this note?')">
                                            Delete
                                        </button>
                                </div>
                                </form>
                            @endif
                        </div>
                        <div class="my-6 p-6 bg-gray-50 border border-gray-200 shadow-sm rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="font-bold text-2xl text-black-800">
                                    <strong>Title: </strong>{{ $title->title }}</a>
                                </h2>
                            </div>
                            <div class="">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="font-bold text-2xl text-blue-800">
                                        <strong>Description: </strong>{{ $title->description }}</a>
                                    </h2>
                                </div>

                            </div>
                        </div>
                @endforeach
            @endforeach
        </div>
    </div>
</x-app-layout>
