<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-md mx-auto bg-white rounded p-6 shadow-xl">
        <h2 class="text-lg font-semibold mb-4">User Form</h2>
        @if ($errors->any())
            <div class="mb-4">
                <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user_task.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Task</label>
                <input type="text" name="task" id="task"
                    class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('task')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="title" class="block text-md font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('due_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="datetime_field" class="block text-sm font-medium text-gray-700">Datetime</label>
                <input type="datetime-local" name="datetime_field" id="datetime_field"
                    class="mt-1 block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('datetime_field')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
                <input type="file" name="attachment" id="attachment"
                    accept=".pdf,.doc,.docx,.mp4,.avi,.mov,.wmv,.jpg"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p class="text-xs text-gray-500 mt-1">Upload PDF, DOC, DOCX, MP4, AVI, MOV, or WMV
                    files. Max size: 20MB.</p>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black">
                    <option value="To-do 🖌️">To-do 🖌️</option>
                    <option value="in-progress 🟠">In-progress 🟠</option>
                    <option value="completed ✅">Completed ✅</option>
                </select>
            </div>
            <div class="mt-4 flex space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-black-400 bg-white-500 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Task
                </button>
                <button type="button" onclick="window.history.back()"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue bg-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Back
                </button>
            </div>
        </form>
    </div>
</body>

</html>
