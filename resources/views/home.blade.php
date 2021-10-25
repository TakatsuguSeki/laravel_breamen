@extends('layout')
@section('title', 'top')
@section('content')
    <div class="row">
        <x-alert type="success" :session="session('success')"/>
    </div>
@endsection
