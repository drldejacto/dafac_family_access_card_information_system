@extends('layouts.admin')

@section('title', 'DAFAC-IS Dashboard')
@section('content_header')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Test You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection