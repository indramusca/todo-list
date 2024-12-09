<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Mengambil semua tugas dari database
        $tasks = Task::all();

        // Mengembalikan view dengan data tugas
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Menyimpan tugas baru ke database
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Mengarahkan kembali ke halaman tugas setelah menyimpan
        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        // Membalikkan status completed (sudah selesai / belum selesai)
        $task->completed = !$task->completed;

        // Menyimpan perubahan status
        $task->save();

        // Mengarahkan kembali ke halaman tugas
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        // Menghapus tugas dari database
        $task->delete();

        // Mengarahkan kembali ke halaman tugas
        return redirect()->route('tasks.index');
    }
}
