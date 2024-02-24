@extends('adminlte::page')



@section('title', '備品管理')

@section('content_header')
<div class="d-flex">
    <h4 class="titlename">備品管理</h4>

    @if(session('success'))
    <div id="successMessage" class="custom-message">
        {{ session('success') }}
    </div>
    @endif
</div>

<!-- 在庫チェック -->
@foreach ($items as $item)
@if($item->stock < $item->minimum_stock)
    <div>
        <p style="color:red; font-weight:bold;">{{ $item->type}}の【 {{ $item->name}} 】の在庫が最低在庫数に達しています</p><br>
    </div>
    @endif
    @endforeach
    @stop

    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- 検索窓 -->
                    <div class="mb-2 d-flex">
                        <div class="input-group input-group-sm">
                            <div class="d-flex">
                                <form class="d-flex text-align-center" action="{{ url('/items/itemsearch') }}" method="get">
                                    @csrf
                                    <input class="search-window" type="text" name="search" placeholder="検索キーワード" value=''>
                                    <button type="submit" class="search-button ms-4">検索</button>
                                </form>
                            </div>
                            <div class="card-tools">

                                <div class="input-group-append">
                                    <a href="{{ url('items/add') }}" class="button">備品登録</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table text-center text-nowrap">
                            <colgroup span="3"></colgroup>
                            <thead>
                                <tr>
                                    <th class="fixed02">ID</th>
                                    <th class="fixed01">備品名</th>
                                    <th class="fixed02">部署</th>
                                    <th class="fixed02">画像</th>
                                    <th class="fixed02">型番・品番</th>
                                    <th class="fixed02">発注先</th>
                                    <th class="fixed02">発注先担当者</th>
                                    <th class="fixed02">発注先電話番号</th>
                                    <th class="fixed02">在庫単位</th>
                                    <th class="fixed02">在庫数</th>
                                    <th class="fixed02">最低在庫数</th>
                                    <th class="fixed02">発注数</th>
                                    <th class="fixed02">単価</th>
                                    <th class="fixed02">登録日時</th>
                                    <th class="fixed02">更新日時</th>
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
                                    <td class="align-middle model_no-column">{{ $item->model_no }}</td>
                                    <td class="align-middle">{{ $item->order_name}}</td>
                                    <td class="align-middle">{{ $item->order_person}}</td>
                                    <td class="align-middle">{{ $item->order_phone}}</td>
                                    <td class="align-middle">{{ $item->stock_unit}}</td>
                                    <td class="align-middle">{{ $item->stock}}</td>
                                    <td class="align-middle">{{ $item->minimum_stock}}</td>
                                    <td class="align-middle">{{ $item->order_quantity}}</td>
                                    <td class="align-middle">{{ $item->price}}</td>
                                    <td class="align-middle">{{ $item->created_at}}</td>
                                    <td class="align-middle">{{ $item->updated_at}}</td>
                                    <div class="align-middle">
                                        <td class="align-middle">
                                            <!-- 編集ボタン -->
                                            <a href="{{ url('/items/'. $item->id .'/edit') }}" class="btn btn-warning">編集</a>
                                        </td>
                                        <td class="align-middle">
                                            <!-- 削除ボタン -->
                                            <form action="/items/{{$item->id}}/delete" method="POST">
                                                {{ csrf_field() }}
                                                <input type="submit" value="削除" class="btn btn-danger btn-dell">
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <!-- 入庫ボタン -->
                                            <form action="/items/{{$item->id}}/storing" method="POST">
                                                @csrf
                                                <input type="submit" value="入庫" class="btn btn-primary btn-storing">
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


        <!-- jquery読込 -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // ページロード後に実行されるコード

                // メッセージが存在する場合
                if ($('#successMessage').length) {
                    // メッセージを3秒後にフェードアウト
                    setTimeout(function() {
                        $('#successMessage').fadeOut('slow');
                    }, 3000);
                }
            });
        </script>

        <!-- データ削除確認用ダイアログ -->
        <script>
            $(function() {
                $(".btn-dell").click(function() {
                    if (confirm("本当に削除しますか？")) {
                        //そのままsubmit（削除）
                    } else {
                        //cancel
                        return false;
                    }
                });
            });
        </script>

        <!-- 入庫確認用ダイアログ -->
        <script>
            $(function() {
                $(".btn-storing").click(function() {
                    if (confirm("入庫確定しますか？")) {
                        //そのままsubmit（削除）
                    } else {
                        //cancel
                        return false;
                    }
                });
            });
        </script>
        @stop

        @section('css')

        <link href="{{ asset('/css/reset.css') }}" rel="stylesheet">

        <!-- オリジナルstylecssファイル -->
        <link href="{{ asset('/css/item.css') }}" rel="stylesheet">

        @stop

        @section('js')
        @stop