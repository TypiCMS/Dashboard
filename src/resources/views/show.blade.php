@extends('core::admin.master')

@section('title', __('Dashboard'))

@section('h1') @endsection

@section('content')

<div class="row">

    <div class="col-sm-12">

        <div class="panel panel-default">

            <div class="panel-heading">
                <h2 class="panel-title">@lang('Welcome, :name!', array('name' => auth()->user()->first_name))</h2>
            </div>

            <div class="panel-body">
                {!! $welcomeMessage !!}
            </div>

        </div>

        @can ('see-history')
        @include('history::admin.latest')
        @endcan

    </div>

</div>

@endsection
