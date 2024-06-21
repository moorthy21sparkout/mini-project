 <x-app-layout>
     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
             {{ __('Create the Task') }}
         </h2>
     </x-slot>

     <div class="py-12">
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md p-6">

                         @if ($errors->any())
                             <div class="alert bg-red-500 text-white p-4 rounded">
                                 <ul>
                                     @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                     @endforeach
                                 </ul>
                             </div>
                         @endif

                         <h2 class="text-blue-500 font-semibold mb-4">Create Task</h2>
                         <form action="{{ route('user_task.store') }}" method="POST" enctype="multipart/form-data">

                             @csrf

                             <div class="mb-4">
                                 <label for="title" class="block text-sm font-medium text-gray-700">Task</label>
                                 <input type="text" name="task" id="task"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black"
                                     required>
                             </div>
                             <div class="mb-4">
                                 <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                 <input type="text" name="title" id="title"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black"
                                     required>
                             </div>
                             <div class="mb-4">
                                 <label for="description"
                                     class="block text-sm font-medium text-gray-700">Description</label>
                                 <textarea name="description" id="description" rows="3"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                             </div>
                             <div class="mb-4">
                                 <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                 <input type="date" name="due_date" id="due_date"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                             </div>
                             <div class="mb-4">
                                 <label for="attachment"
                                     class="block text-sm font-medium text-gray-700">Attachment</label>
                                 <input type="file" name="attachment" id="attachment"
                                     accept=".pdf,.doc,.docx,.mp4,.avi,.mov,.wmv,.jpg"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                 <p class="text-xs text-gray-500 mt-1">Upload PDF, DOC, DOCX, MP4, AVI, MOV, or WMV
                                     files. Max size: 20MB.</p>
                             </div>
                             <div class="mb-4">
                                 <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                 <select name="status" id="status"
                                     class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black"
                                     required>
                                     <option value="To-do🖌️">To-do🖌️</option>
                                     <option value="in-progress🟠">In-progress🟠</option>
                                     <option value="completed ✅">Completed ✅</option>
                                 </select>
                             </div>
                             <div class="mt-4 flex space-x-4">
                                 <button type="submit"
                                     class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                     Create Task
                                 </button>
                                 <button type="button" onclick="window.history.back()"
                                     class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                     Back
                                 </button>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>


 {{-- <div class="mb-4">
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To</label>
                                <select name="user_id" id="user_id"
                                    class="mt-1 text-black block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
