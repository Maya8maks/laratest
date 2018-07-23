@extends('layouts.site')
@section('header')
    @include('template.question.header')
@endsection
@section('sidebar')
    @include('template.question.question_sidebar')
@endsection
@section('content')
    @include('template.question.question_prepareToPay')
@endsection
@section('footer')
    @include('footer')
@endsection