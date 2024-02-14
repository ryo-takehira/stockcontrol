@extends('adminlte::page')

<!-- オリジナルstylecssファイル -->
<link href="{{ asset('/css/item.css') }}" rel="stylesheet">

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


                        @if(session('success'))
                        <div id="successMessage" class="custom-message mt-4">
                            {{ session('success') }}
                        </div>
                        @endif
                        
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">備品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table text-center text-nowrap">
                    <colgroup span="3"></colgroup>
                        <thead>
                            <tr>
                                <th class="fixed02">ID</th>
                                <th class="fixed01">備品名</th>
                                <th class="fixed02">部署</th>
                                <th class="fixed02">画像</th>
                                <th class="fixed02">型番</th>
                                <th class="fixed02">発注先</th>
                                <th class="fixed02">発注先担当者</th>
                                <th class="fixed02">発注先電話番号</th>
                                <th class="fixed02">在庫単位</th>
                                <th class="fixed02">在庫数</th>
                                <th class="fixed02">最低在庫数</th>
                                <th class="fixed02">発注数</th>
                                <th class="fixed02">単価</th>
                                <th class="fixed02 column_operation" colspan="3" scope="colgroup">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->id }}</td>
                                    <td class="align-middle fixed02">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->type }}</td>
                                    <td class="align-middle">
                                    <div style="width:100px;"><img src="{!! $item->image_name !!}" alt="IMAGE" style="width:100%; height:50%;"></div>
                                    </td>
                                    <td class="align-middle">{{ $item->model_no }}</td>
                                    <td class="align-middle">{{ $item->order_name}}</td>
                                    <td class="align-middle">{{ $item->order_person}}</td>
                                    <td class="align-middle">{{ $item->order_phone}}</td>
                                    <td class="align-middle">{{ $item->stock_unit}}</td>
                                    <td class="align-middle">{{ $item->stock}}</td>
                                    <td class="align-middle">{{ $item->minimum_stock}}</td>
                                    <td class="align-middle">{{ $item->order_quantity}}</td>
                                    <td class="align-middle">{{ $item->price}}</td>
                                    <div class="align-middle">
                                    <td class="align-middle">
                                        <!-- 編集ボタン -->
                                        <a href="{{ url('/item/'. $item->id . '/edit') }}" class="btn btn-warning">編集</a>
                                    </td>
                                    <td class="align-middle">
                                        <!-- 削除ボタン -->
                                        <form action="/item/{{$item->id}}/delete" method="POST">
                                            {{ csrf_field() }}
                                            <input type="submit" value="削除" class="btn btn-danger">
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <!-- 入庫ボタン -->
                                        <form action="/item/{{$item->id}}/storing" method="POST">
                                            @csrf
                                            <input type="submit" value="入庫" class="btn btn-primary">
                                        </form>
                                    </td>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="page-link">
                    <div class="row">
                        <div class="col-6">
                            {{ $items->appends(request()->query())->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
