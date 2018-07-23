@extends('layouts.site')
@section('header')
    @include('template.admin.header')
@endsection
@section('sidebar')
    @include('template.admin.sidebar')
@endsection
@section('content')
    @include('template.admin.admin_index')
@endsection
@section('footer')
    @include('footer')
@endsection