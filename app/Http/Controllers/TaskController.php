<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function index() {
        // 로그인을 한 유저가 가진 태스크들을 최신순으로 가져와달라
        $tasks = auth()->user()->tasks()->latest()->get();
        // $tasks = Task::latest()->where('user_id', auth()->id())->get();
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    public function create() {
        return view('tasks.create');
    }

    public function store() {

        request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $values = request(['title', 'body']);
		$values['user_id'] = auth()->id();
		
		$task = Task::create($values);
        // $task = Task::create([
        //     'title' => request('title'),
        //     'body' => request('body')
        // ]);

        return redirect('/tasks/'.$task->id);
    }

    public function show(Task $task) {
        // if(auth()->id() != $task->user_id) {
        //     abort(403);
        // }

        // abort_if(auth()->id() != $task->user_id, 403);

        // abort_if(!auth()->user()->owns($task), 403);

        abort_unless(auth()->user()->owns($task), 403);

        return view('tasks.show', [
            'task'=> $task
        ]);
    }

    public function edit(Task $task) {
        return view('tasks.edit', [
            'task'=> $task
        ]);
    }

    public function update(Task $task) {
        abort_unless(auth()->user()->owns($task), 403);
        request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $task->update(request(['title', 'body']));
        return redirect('/tasks/'.$task->id);
    }


    public function destroy(Task $task) {
        $task->delete();

        return redirect('/tasks');
    }
}
