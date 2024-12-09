<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- Tambahkan CSS dari Tailwind CSS atau Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center">
    <div class="container mx-auto py-10">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
            <h1 class="text-2xl font-bold text-center mb-6">To-Do List</h1>

            <!-- Form Tambah Tugas -->
            <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Task Title</label>
                    <input type="text" id="title" name="title" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter task title" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description (optional)</label>
                    <textarea id="description" name="description" class="w-full mt-1 p-2 border rounded-lg" rows="3" placeholder="Enter task description"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                    Add Task
                </button>
            </form>

            <!-- Daftar Tugas -->
            @if($tasks->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach ($tasks as $task)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->title }}
                                </h2>
                                <p class="text-sm text-gray-600">{{ $task->description }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <!-- Tombol Toggle Status -->
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm px-4 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                        {{ $task->completed ? 'Undo' : 'Complete' }}
                                    </button>
                                </form>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm px-4 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center text-gray-500">No tasks available. Add a new task above!</p>
            @endif
        </div>
    </div>
</body>
</html>
