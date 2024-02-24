@extends('adminlte::page')

@section('title', 'stockcontrol')

@section('content_header')
    <h5>ようこそ{!! $auth_user->name !!}さん</h5>
@stop

@section('content')
    <p>Let's share what we use with care.</p>
    @foreach ($items as $item)
    <ul>
    <li style="width:100px; height:100px; display:inline-block; float:left;"><img src="{!! $item->image_name !!}" alt="IMAGE" style="width:100%; height:100%;"></li>
    </ul>
    @endforeach






@stop









@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
