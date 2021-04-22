@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div id="app">
                        <chat-app :user="{{ Auth::user() }}"></chat-app>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
