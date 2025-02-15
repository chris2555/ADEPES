@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

@section('content')
    @yield('content_body')
@stop
