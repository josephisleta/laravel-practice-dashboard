<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Http\Requests\TaskFormRequest;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('user.task', ['only' => [
            'show',
            'edit',
            'destroy',
        ]]);
    }

    public function index()
    {
        return $this->redirectToIndex();
    }

    public function show(Task $task)
    {
        return $this->redirectToTask($task);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskFormRequest $request)
    {
        Auth::user()->tasks()->create($request->all());
        Session::flash('status', Task::FLASH_CREATED_TASK);

        return $this->redirectToIndex();
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, TaskFormRequest $request)
    {
        $task->update($request->all());
        if ($request->get('status')) {
            $task->status = 1;
        } else {
            $task->status = 0;
        }
        $task->save();
        Session::flash('status', Task::FLASH_EDITED_TASK);

        return $this->redirectToTask($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        Session::flash('status', Task::FLASH_DELETED_TASK);

        return redirect('/tasks');
    }

    public function getCompleted()
    {
        return $this->redirectToIndex(Task::STATUS_DONE, Task::TYPE_COMPLETED);
    }

    public function getOverdue()
    {
        return $this->redirectToIndex(Task::STATUS_PENDING, Task::TYPE_OVERDUE, Carbon::now());
    }

    public function setDone(Task $task, Request $request)
    {
        $task->update($request->all());

        return back();
    }

    public function redirectToIndex($status = Task::STATUS_PENDING, $type = Task::TYPE_ACTIVE, $due_date = Carbon::DEFAULT_TO_STRING_FORMAT)
    {
        $tasks = Task::latest()
                        ->where('user_id', Auth::user()->id)
                        ->where('status', $status)
                        ->where('due_date', '<=' , $due_date)
                        ->get();

        return view('tasks.index', compact('tasks', 'type'));
    }

    private function redirectToTask(Task $task)
    {
        $notes = $task->notes()->get();

        return view('tasks.show', compact('task', 'notes'));
    }
}