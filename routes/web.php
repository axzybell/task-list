<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use \App\Models\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        //paginate to display how many data and will automatically added next and prev
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

//create new tasks into database
Route::post('/tasks', function(TaskRequest $request) {
    //validation rules
    $task = Task::create($request->validated());

    //display flush messages with the session using with()
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');


//Update database existing data
Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    //validation rules
    $task->update($request->validated());

    //display flash messages with the session using with()
    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

//Delete data on database
Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task Updated Successfully');
})->name('tasks.toggle-complete');



Route::get('/dbconn', function() {
    return view('dbconn');
});

Route::fallback(function() {
    return 'Still Got Something';
});
