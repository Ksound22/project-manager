<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project, Task $task)
    {
        $project->load('tasks');

        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,in-progress,completed,on-hold',
        ]);

        Task::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);


        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Task $task)
    {
        $project = $task->project;

        return view('tasks.edit', compact('project', 'task'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,in-progress,completed,on-hold',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.show', $task->project)->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $task->project)->with('success', 'Task deleted successfully!');
    }
}
