@extends('layouts.site')
@section('header')
    @include('template.admin.header')
@endsection
@section('sidebar')
    @include('template.admin.sidebar')
@endsection
@section('content')
    @include('template.admin.admin_account_content')
@endsection
@section('footer')
    @include('footer')
@endsection