<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Task;

class CheckIfUserCreatedTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $task = Task::findOrFail($request->segments()[1]);

        if (Auth::user()->id !== $task->user_id) {
            return redirect('/tasks');
        }

        return $next($request);
    }
}
