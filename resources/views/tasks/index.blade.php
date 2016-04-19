@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>{{ $type }} Tasks </h2>
                        @unless ($tasks->isEmpty())
                            <p class="small">Displaying {{ $count }} {{ $type }} tasks</p>
                        @endunless
                        @if($type == 'Active')
                            <a href="{{ action('TasksController@create') }}" class="btn btn-xs btn-info">Create New</a>
                        @endif
                    </div>

                    @include('session.partial')

                    @if ($tasks->isEmpty())
                        <p> You have no {{ $type }} task.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Created</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ date_format(date_create($task->created_at), 'M d, Y H:i:s') }} </td>
                                        <td>
                                            <a href="{!! action('TasksController@show', $task->id) !!}">{!! $task->title !!}</a>
                                        </td>
                                        <td>{!! $task->status ? 'Done' : 'Pending' !!}</td>
                                        @if($task->due_date <= \Carbon\Carbon::now() && $task->status == \App\Task::STATUS_PENDING)
                                            <td class="text-danger">
                                                {{ date_format(date_create($task->due_date), 'M d, Y H:i:s') }}
                                            </td>
                                        @else
                                            <td class="text-default">
                                                {{ date_format(date_create($task->due_date), 'M d, Y H:i:s') }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $tasks->render() }}
                        </div>
                    @endif
                </div>
        </div>
    </div>
</div>
@endsection