<?php

namespace App\Http\Controllers;

use App\Models\Task;
// kita harus melakukan import Model terlebih dahulu kedalam file controller agar 
// dapat digunakan
use Illuminate\Http\Request;

class TodoTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        // Task merupakan model yang kita panggilan, yaitu model Task, 
        // all() merupakan function untuk mengambil semua isi dari dalam table 'tasks'
        // didatabse, atau model 'Task'.

        return view('home', [
            'tasks' => $tasks,
            // kita mengirimkan selurh data dari model Task kedalam View home.
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate(
            [
                'task' => 'required|min:5',
            ],
            [
                'task.required' => 'Tugas harus diisi',
                'task.min' => 'Tugas minimal 5 karakter',
            ]
            );

        Task::create([
        'task' => $request -> task,
        'tanggal' => NOW(),
        ]);

        return redirect('/');
    }

    // public function destroy(Request $request)
    // {
    //     Task::destroy($request->id);
    //     return redirect('/');
    // }

    public function deleteTask(Request $request)
    {
        Task::where('id', $request->id)->delete();
        return redirect('/');
    }

    // public function destroy($id)
    // {
    //     Task::where('task_id', $id)->delete();
    //     return redirect('/dashboard/posts');
    // }

    // public function deleteTask($id)
    // {
    //     $task = Task::findOrFail($id);
    //     $task->delete();
        
    //     return redirect('/');
    // }

}