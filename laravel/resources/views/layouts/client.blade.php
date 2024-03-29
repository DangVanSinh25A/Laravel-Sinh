@extends('layouts.client')
{{-- <h1>sinh</h1> --}}
@section('title')
    {{$title}}
@endsection
@section('content')
@if(session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
@endif
    <h1>{{$title}}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width= "5%">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th width= "25%">Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($users))
                @foreach($users as $key => $user)
                    <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    </tr> 
                @endforeach        
            @else
                <tr>
                    <td>Không có người dùng</td>
                </tr>
            @endif
        </tbody>
    </table>
    @endsection