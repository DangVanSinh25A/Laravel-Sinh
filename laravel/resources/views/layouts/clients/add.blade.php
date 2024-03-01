@extends('layouts.client')
@section('title')
{{$title}}
@endsection
@section('content')
<h1>Thêm Sản Phẩm</h1>
<form action="" method="Post">
    <input type="text" name="username">
    <input type="hidden" name='_token' value="{{csrf_token()}}">
    <button type="submit">Submit</button>
    @method('PUT');
</form>
@endsection

@section('css')
@endsection