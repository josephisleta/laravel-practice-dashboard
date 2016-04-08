@extends('layouts.app')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form class="form-horizontal" method="POST">
                @include('errors.partial')
                @include('session.partial')

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>Edit task</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" name="title" value="{!! $task->title !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Body</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="body">{!! $task->body !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Due Date</label>
                        <div class="col-lg-10">
                            <input type="hidden" name="created_at" value="{{ $task->created_at }}">
                            <input type="date" class="form-control" id="title" placeholder="Due Date" name="due_date" value="{{ date_format(date_create($task->due_date), 'Y-m-d') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="status" {!! $task->status?"checked":""!!} > Done with this task?
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection