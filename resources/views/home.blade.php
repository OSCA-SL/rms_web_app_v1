@extends('layouts.master')

@section('content')
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            Welcome
        </div>

    </div>
@endsection
