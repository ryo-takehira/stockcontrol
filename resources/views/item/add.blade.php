@extends('adminlte::page')

@section('title', '備品登録')

@section('content_header')
<h1>備品登録</h1>
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
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">備品名</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="備品名" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>保管場所</label>
                        <select class="form-control" name="type" id="type" placeholder="保管場所">
                            <option value="" {{ old('type') == '' ? 'selected' : '' }}>>選択してください</option>
                            <option value="事務所" {{ old('type') == '事務所' ? 'selected' : '' }}>事務所</option>
                            <option value="CAD室" {{ old('type') == 'CAD室' ? 'selected' : '' }}>CAD室</option>
                            <option value="第一工場" {{ old('type') == '第一工場' ? 'selected' : '' }}>第一工場</option>
                            <option value="第二工場" {{ old('type') == '第二工場' ? 'selected' : '' }}>第二工場</option>
                            <option value="第三工場" {{ old('type') == '第三工場' ? 'selected' : '' }}>第三工場</option>
                            <option value="第四工場" {{ old('type') == '第四工場' ? 'selected' : '' }}>第四工場</option>
                            <option value="発送" {{ old('type') == '発送' ? 'selected' : '' }}>発送</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image_name">画像</label><br>
                        <input type="file" id="imageSelect" name="image_name" accept="image/*"><br>

                        <img id="selectedImage" style="max-width: 100%; max-height: 300px;"><br>

                        <script>
                            const imageSelect = document.getElementById("imageSelect");
                            const selectedImage = document.getElementById("selectedImage");

                            imageSelect.addEventListener("change", (e) => {
                                const file = e.target.files[0];

                                if (file) {
                                    const reader = new FileReader();

                                    reader.onload = (event) => {
                                        selectedImage.src = event.target.result;
                                        selectedImage.style.display = "block";
                                    };

                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="model_no">型番・品番</label>
                            <input type="text" class="form-control" id="model_no" name="model_no" placeholder="型番・品番" value="{{ old('model_no') }}">
                        </div>

                        <div class="form-group">
                            <label for="order_name">発注先</label>
                            <input type="text" class="form-control" id="order_name" name="order_name" placeholder="発注先" value="{{ old('order_name') }}">
                        </div>

                        <div class="form-group">
                            <label for="order_person">発注先担当者</label>
                            <input type="text" class="form-control" id="order_person" name="order_person" placeholder="発注先担当者" value="{{ old('order_person') }}">
                        </div>

                        <div class="form-group">
                            <label for="order_phone">発注先電話番号</label>
                            <input type="phone" class="form-control" id="order_phone" name="order_phone" placeholder="発注先電話番号" value="{{ old('order_phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="stock_unit">在庫単位</label>
                            <input type="text" class="form-control" id="stock_unit" name="stock_unit" placeholder="在庫単位：本、個、梱包、束など" value="{{ old('stock_unit') }}">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="在庫数" value="{{ old('stock') }}">
                        </div>

                        <div class="form-group">
                            <label for="minimum_stock">最低在庫数</label>
                            <input type="number" class="form-control" id="minimum_stock" name="minimum_stock" placeholder="最低在庫数" value="{{ old('minimum_stock') }}">
                        </div>

                        <div class="form-group">
                            <label for="order_quantity">発注数</label>
                            <input type="number" class="form-control" id="order_quantity" name="order_quantity" placeholder="発注数" value="{{ old('order_quantity') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">単価</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="単価" value="{{ old('price') }}">
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