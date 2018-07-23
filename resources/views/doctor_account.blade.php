@extends('layouts.site')
@section('header')
    @include('template.doctor.header')
@endsection
@section('sidebar')
    @include('template.doctor.sidebar')
@endsection
@section('content')
    @include('template.doctor.doctor_account_content')
@endsection
@section('footer')
    @include('footer')
@endsection