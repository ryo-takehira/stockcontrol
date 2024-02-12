@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>備品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">備品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">備品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>備品名</th>
                                <th>部署</th>
                                <th>画像</th>
                                <th>型番</th>
                                <th>発注先</th>
                                <th>発注先担当者</th>
                                <th>発注先電話番号</th>
                                <th>在庫数</th>
                                <th>最低在庫数</th>
                                <th>発注数</th>
                                <th>単価</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->image_name }}</td>
                                    <td>{{ $item->model_no }}</td>
                                    <td>{{ $item->order_name}}</td>
                                    <td>{{ $item->order_person}}</td>
                                    <td>{{ $item->order_phone}}</td>
                                    <td>{{ $item->stock}}</td>
                                    <td>{{ $item->minimum_stock}}</td>
                                    <td>{{ $item->order_quantity}}</td>
                                    <td>{{ $item->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
