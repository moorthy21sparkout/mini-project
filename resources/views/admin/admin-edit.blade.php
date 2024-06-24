<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin-update', $task->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-4">
                            <label for="task" class="block text-gray-700">Task</label>
                            <input type="text" name="task" id="task" value="{{ $task->task }}"
                                class="w-full mt-1 p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                value="{{ $task->titles->first()->title }}"
                                class="w-full mt-1 p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" class="w-full mt-1 p-2 border border-gray-300 rounded">{{ $task->titles->first()->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="due_date" class="block text-gray-700">Due Date</label>
                            <input type="date" name="due_date" id="due_date"
                                value="{{ $task->titles->first()->due_date }}"
                                class="w-full mt-1 p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="attachment" class="block text-gray-700">Attachment</label>
                            <input type="file" name="attachment" id="attachment"
                                class="w-full mt-1 p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black"
                                required>
                                <option value="To-do">To-do 🖌️</option>
                                <option value="in-progress">In-progress🟠</option>
                                <option value="completed">Completed: ✅</option>
                            </select>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

