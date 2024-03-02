@extends('adminlte::page')



@section('title', '備品一覧')

@section('content_header')
<div class="d-flex">
    <h4 class="titlename">備品一覧</h4>

    @if(session('success'))
    <div id="successMessage" class="custom-message">
        {{ session('success') }}
    </div>
    @endif
</div>

<!-- 在庫チェック -->
<!-- @foreach ($items_all as $item_all)
@if($item_all->stock < $item_all->minimum_stock)
    <div>
        <p style="color:red; font-weight:bold;">{{ $item_all->type}}の【 {{ $item_all->name}} 】の在庫が最低在庫数に達しています</p><br>
    </div>
    @endif
    @endforeach -->
    @stop

    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- 検索窓 -->
                    <div class="mb-2">
                        <div class="input-group input-group-sm">
                            <div class="d-flex">
                                <form class="d-flex text-align-center" action="{{ url('/items/used_itemsearch') }}" method="get">
                                    @csrf
                                    <input class="search-window" type="text" name="used_search" placeholder="検索キーワード" value=''>
                                    <button type="submit" class="search-button ms-4">検索</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table text-center text-nowrap">
                            <thead>
                                <tr>
                                    <th class="fixed02">ID</th>
                                    <th class="fixed01">備品名</th>
                                    <th class="fixed02">保管場所</th>
                                    <th class="fixed02">画像</th>
                                    <th class="fixed02">型番・品番</th>
                                    <th class="fixed02">在庫単位</th>
                                    <th class="fixed02">在庫数</th>
                                    <th class="fixed02">最低在庫数</th>
                                    <th class="fixed02">発注数</th>
                                    <th class="fixed02">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->id }}</td>
                                    <td class="align-middle fixed02 word-break">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->type }}</td>
                                    <td class="align-middle">
                                        <div style="width:100px;"><img src="{!! $item->image_name !!}" alt="IMAGE" style="width:100%; height:50%;"></div>
                                    </td>
                                    <td class="align-middle word-break">{{ $item->model_no }}</td>
                                    <td class="align-middle">{{ $item->stock_unit}}</td>
                                    <td class="align-middle">{{ $item->stock}}</td>
                                    <td class="align-middle">{{ $item->minimum_stock}}</td>
                                    <td class="align-middle">{{ $item->order_quantity}}</td>
                                    <td class="align-middle">
                                        <!-- 持出ボタン -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#itemModalLabel{{ $item->id }}">
                                            持出
                                        </button>
                                        <!-- 備品持出入力モーダル -->
                                        @include('modals.item_modal', ['item' => $item])
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
    @stop

    @section('css')

    <link href="{{ asset('/css/reset.css') }}" rel="stylesheet">

    <!-- オリジナルstylecssファイル -->
    <link href="{{ asset('/css/item.css') }}" rel="stylesheet">

    @stop

    @section('js')
    <!-- Bootstrap JavaScriptのリンク -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stop