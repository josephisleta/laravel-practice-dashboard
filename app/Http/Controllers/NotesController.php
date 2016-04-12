<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Note;

class NotesController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $validation = [
            'content' => 'required|min:1'
        ];

        $this->validate($request, $validation);

        $note = [];
        $note['content'] = $request->get('content');
        $note['user_id'] = $request->user()->id;
        $task->notes()->create($note);

        return back();
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return back();
    }
}
