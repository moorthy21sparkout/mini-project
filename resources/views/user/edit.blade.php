<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Form</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-md mx-auto bg-white rounded p-6 shadow-xl">
        <h2 class="text-lg font-semibold mb-4">Admin Form</h2>
        @if ($errors->any())
            <div class="mb-4">
                <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user_task.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="task" class="block text-gray-700">Task</label>
                <input type="text" name="task" id="task" value="{{ $task->task }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $task->titles->first()->title }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" class="w-full mt-1 p-2 border border-gray-300 rounded">{{ $task->titles->first()->description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ $task->titles->first()->due_date }}"
                    class="w-full mt-1 p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="datetime_field" class="block text-sm font-medium text-gray-700">Datetime</label>
                <input type="datetime-local" name="datetime_field" id="datetime_field"
                    class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('datetime_field')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
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
                    <option value="To-do 🖌️" {{ $task->titles->first()->status == 'To-do 🖌️' ? 'selected' : '' }}>
                        To-do 🖌️</option>
                    <option value="in-progress 🟠"
                        {{ $task->titles->first()->status == 'in-progress 🟠' ? 'selected' : '' }}>In-progress 🟠
                    </option>
                    <option value="completed ✅" {{ $task->titles->first()->status == 'completed ✅' ? 'selected' : '' }}>
                        Completed ✅</option>

                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
