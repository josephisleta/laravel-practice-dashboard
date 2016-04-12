@extends('layouts.app')
@section('title', 'Create a new task')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form class="form-horizontal" method="POST">
                @include('errors.partial')
                @include('session.partial')

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>Create a new task</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="title" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Body</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="body">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Due Date</label>
                        <div class="col-lg-10">
                            <input type="hidden" name="created_at" value="{{ \Carbon\Carbon::now() }}">
                            <input type="date" class="form-control" id="title" placeholder="Due Date" name="due_date" value="{{ old('due_date') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection