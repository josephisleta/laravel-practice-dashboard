@extends('layouts.app')

@section('content')

    <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <div class="panel panel-heading">
                @include('session.partial')
                    <div class="text text-info small">
                        {{ date_format(date_create($task->created_at), 'M d, Y H:i:s') }}
                        @if($task->status)
                            <div class="label label-success">Done</div>
                        @else
                            <div class="label label-info">Pending</div>
                        @endif
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


                <div class="panel panel-body">
                    <div class="content container highlight">
                        <p> {!! $task->body !!} </p>
                    </div>
                    <br />
                    @unless($task->status)
                    <div class="control-label small pull-right">
                        Due Date: {{ date_format(date_create($task->due_date), 'M d, Y H:i:s') }}
                    </div>
                    <br />
                    <form method="post" action="{{ action('TasksController@setDone', $task->id) }}" class="pull-right">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="status" value="1" >
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary right">Set Task Done</button>
                            </div>
                        </div>
                    </form>
                    @endunless
                </div>
            </div>
            <div class="well well bs-component">
                <div class="text text-info">
                @foreach($notes as $note)
                    <div class="panel panel-body">
                        <div class="glyphicon-italic small">
                            {{ $note->created_at }}
                            <form method="post" action="{{ action('NotesController@destroy', $note->id) }}" class="btn btn-xs pull-right">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <button type="submit">x</button>
                            </form>
                        </div>
                        <div class="text-primary">
                            {{ $note->content }}
                        </div>
                    </div>
                @endforeach
                </div>
                <form class="form-horizontal" method="POST" action="{{ action('NotesController@store', $task->id) }}">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <fieldset>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">New Note</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Post Note</button>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>
    </div>

@endsection