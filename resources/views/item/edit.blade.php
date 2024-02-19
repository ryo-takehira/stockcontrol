@extends('adminlte::page')

@section('title', '備品編集')

@section('content_header')
<h1>備品編集</h1>
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
            <form method="POST" action="{{ url('/items/' . $item->id . '/edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <input type="hidden" name="item_id" id="item_id" value="{!! $item->id !!}">

                    <div class="form-group">
                        <label for="name">備品名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="備品名：{{ $item->name }}" value="{{ $item->name }}">
                    </div>

                    <div class="form-group">
                        <label>部署</label>
                        <select class="form-control" name="type" id="type">
                            <option value="{{ $item->type }}" {{ old('type') == '' ? 'selected' : '' }}>{{ $item->type }}</option>
                            <option value="営業" {{ old('type') == '営業' ? 'selected' : '' }}>営業</option>
                            <option value="事務" {{ old('type') == '事務' ? 'selected' : '' }}>事務</option>
                            <option value="CAD" {{ old('type') == 'CAD' ? 'selected' : '' }}>CAD</option>
                            <option value="第１工場" {{ old('type') == '第１工場' ? 'selected' : '' }}>第１工場</option>
                            <option value="第２工場" {{ old('type') == '第２工場' ? 'selected' : '' }}>第２工場</option>
                            <option value="第３工場" {{ old('type') == '第３工場' ? 'selected' : '' }}>第３工場</option>
                            <option value="第４工場" {{ old('type') == '第４工場' ? 'selected' : '' }}>第４工場</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image_name">画像</label><br>

                        <input type="file" name="image_name" id="imageElem" multiple accept="image/*" style="display:none" value="{{ $item->image_name }}" />
                        <button id="imageSelect" type="button">画像を選択</button>
                        <script>
                            const imageSelect = document.getElementById("imageSelect");
                            const imageElem = document.getElementById("imageElem");

                            imageSelect.addEventListener("click", (e) => {
                                if (imageElem) {
                                    imageElem.click();
                                }
                            }, false);
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="model_no">型番・品番</label>
                        <input type="text" class="form-control" id="model_no" name="model_no" placeholder="型番：{{ $item->model_no }}" value="{{ $item->model_no }}">
                    </div>

                    <div class="form-group">
                        <label for="order_name">発注先</label>
                        <input type="text" class="form-control" id="order_name" name="order_name" placeholder="発注先：{{ $item->order_name }}" value="{{ $item->order_name }}">
                    </div>

                    <div class="form-group">
                        <label for="order_person">発注先担当者</label>
                        <input type="text" class="form-control" id="order_person" name="order_person" placeholder="発注先担当者：{{ $item->order_person }}" value="{{ $item->order_person }}">
                    </div>

                    <div class="form-group">
                        <label for="order_phone">発注先電話番号</label>
                        <input type="phone" class="form-control" id="order_phone" name="order_phone" placeholder="発注先電話番号：{{ $item->order_phone }}" value="{{ $item->order_phone }}">
                    </div>

                    <div class="form-group">
                        <label for="stock_unit">在庫単位</label>
                        <input type="text" class="form-control" id="stock_unit" name="stock_unit" placeholder="在庫単位：{{ $item->stock_unit }}" value="{{ $item->stock_unit }}">
                    </div>

                    <div class="form-group">
                        <label for="stock">在庫数</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="在庫数：{{ $item->stock }}" value="{{ $item->stock }}">
                    </div>

                    <div class="form-group">
                        <label for="minimum_stock">最低在庫数</label>
                        <input type="number" class="form-control" id="minimum_stock" name="minimum_stock" placeholder="最低在庫数：{{ $item->minimum_stock }}" value="{{ $item->minimum_stock }}">
                    </div>

                    <div class="form-group">
                        <label for="order_quantity">発注数</label>
                        <input type="number" class="form-control" id="order_quantity" name="order_quantity" placeholder="発注数：{{ $item->order_quantity }}" value="{{ $item->order_quantity }}">
                    </div>

                    <div class="form-group">
                        <label for="price">単価</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="単価：{{ $item->price }}" value="{{ $item->price }}">
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