@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if (Auth::user())
                    <div class="panel-body">
                        You are logged in!
                    </div>
                @else
                    <div class="panel-body">
                        Please login or create new account to use the dashboard.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
