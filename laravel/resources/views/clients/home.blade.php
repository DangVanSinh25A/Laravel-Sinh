@extends('layouts.client')
@section('titlet')
<h1>Trang chủ - </h1>
@endsection
@section('sidebar')
@parent
<h1>Home Sidebar</h1>


@endsection

@section ('content')
<h1> Trang chủ </h1>
<x-alert type="info" :content="$message" data-icon="youtube"/>
<!-- <x-inputs.button/>

<x-forms.button /> -->
@endsection

@section ('css')
@endsection