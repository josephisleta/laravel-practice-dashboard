@extends('layouts.app')

@section('content')

    <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <div class="panel panel-heading">
                    <div class="text text-info">
                        {{ date_format(date_create($task->created_at), 'M d, Y H:i:s') }}
                    </div>
                    <h1 class="header">{!! $task->title !!}</h1>
                        <a href="{{ action('TasksController@edit', $task->id) }}" class="btn btn-xs btn-toolbar">Edit</a>
                        <form method="post" action="{{ action('TasksController@destroy', $task) }}" class="pull-left">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-xs btn-toolbar">Delete</button>
                                </div>
                            </div>
                        </form>
                </div>
                @if($task->status)
                    <div class="label label-success">Done</div>
                @else
                    <div class="label label-info">Pending</div>
                @endif

                <div class="panel panel-body">
                    <div class="content container">
                        <p> {!! $task->body !!} </p>
                    </div>
                    <br />
                    @unless($task->status)
                    <div class="control-label">
                        <div class="label label-warning">
                        Due Date {{ date_format(date_create($task->due_date), 'M d, Y H:i:s') }}
                        </div>
                    </div>
                    <br />
                    <form method="post" action="{{ action('TasksController@setDone', $task->id) }}" class="pull-left">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="status" value="1" >
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary">Set Task Done</button>
                            </div>
                        </div>
                    </form>
                    @endunless
                </div>
            </div>
    </div>

@endsection