@extends('adminlte::page')

@section('title', 'ユーザー編集')

@section('content_header')
<h1>ユーザー編集</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <form method="POST" action="{{ url('/users/' . $user->id . '/edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <input type="hidden" name="user_id" id="user_id" value="{!! $user->id !!}">

                    <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ユーザー名：{{ $user->name }}" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label>権限</label>
                        <select class="form-control" name="isAdmin" id="isAdmin">
                            <!-- <option value="{{ $user->isAdmin }}" {{ old('isAdmin') == '' ? 'selected' : '' }}>{{ $user->isAdmin }}</option> -->
                            <option value="10" {{ $user->isAdmin == 10 ? 'selected' : '' }}>一般ユーザー</option>
                            <option value="1" {{ $user->isAdmin == 1 ? 'selected' : '' }}>master</option>
                            <option value="2" {{ $user->isAdmin == 2 ? 'selected' : '' }}>営業</option>
                            <option value="3" {{ $user->isAdmin == 3 ? 'selected' : '' }}>事務</option>
                            <option value="4" {{ $user->isAdmin == 4 ? 'selected' : '' }}>CAD</option>
                            <option value="5" {{ $user->isAdmin == 5 ? 'selected' : '' }}>第１工場</option>
                            <option value="6" {{ $user->isAdmin == 6 ? 'selected' : '' }}>第２工場</option>
                            <option value="7" {{ $user->isAdmin == 7 ? 'selected' : '' }}>第３工場</option>
                            <option value="8" {{ $user->isAdmin == 8 ? 'selected' : '' }}>第４工場</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop