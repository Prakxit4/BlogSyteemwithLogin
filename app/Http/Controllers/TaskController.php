<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z]+$/'],
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.regex' => 'The name field should only contain letters.',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $data['image'] = basename($imagePath);
        }

        Task::create($data);

        Session::flash('success', 'Blog created successfully.');

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z]+$/'],
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.regex' => 'The name field should only contain letters.',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $data['image'] = basename($imagePath);
        }

        $task->update($data);

        Session::flash('success', 'Blog updated successfully.');

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->image) {
            Storage::delete('public/images/' . $task->image);
        }
    
        $task->delete();
    
        Session::flash('success', 'Blog deleted successfully.');
    
        return redirect()->route('tasks.index');
    }
}
