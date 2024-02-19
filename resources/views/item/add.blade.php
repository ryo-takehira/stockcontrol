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
                        <label>部署</label>
                        <select class="form-control" name="type" id="type" placeholder="部署">
                            <option value="" {{ old('type') == '' ? 'selected' : '' }}>>選択してください</option>
                            <option value="営業" {{ old('type') == '営業' ? 'selected' : '' }}>営業</option>
                            <option value="事務" {{ old('type') == '事務' ? 'selected' : '' }}>事務</option>
                            <option value="CAD" {{ old('type') == 'CAD' ? 'selected' : '' }}>CAD</option>
                            <option value="第１工場" {{ old('type') == '第１工場' ? 'selected' : '' }}>第１工場</option>
                            <option value="第２工場" {{ old('type') == '第２工場' ? 'selected' : '' }}>第２工場</option>
                            <option value="第３工場" {{ old('type') == '第３工場' ? 'selected' : '' }}>第３工場</option>
                            <option value="第４工場" {{ old('type') == '第４工場' ? 'selected' : '' }}>第４工場</option>
                        </select>
                    </div>


                    <!-- <div class="form-group" role="group">
                            <button type="button" class="form-control text-center custom-btn" data-bs-toggle="dropdown" aria-expanded="false" id="type">
                                部署
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-value="事務">事務</a></li>
                                <li><a class="dropdown-item" href="#" data-value="CAD">CAD</a></li>
                                <li><a class="dropdown-item" href="#" data-value="第一工場">第一工場</a></li>
                                <li><a class="dropdown-item" href="#" data-value="第二工場">第二工場</a></li>
                                <li><a class="dropdown-item" href="#" data-value="第三工場">第三工場</a></li>
                                <li><a class="dropdown-item" href="#" data-value="第四工場">第四工場</a></li>
                            </ul>
                        </div>
                    </div>

                    <input type="hidden" name="type" id="type_name" value="">

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // ドロップダウンメニューのアイテムがクリックされたときのイベントリスナーを追加
                            var dropdownItems = document.querySelectorAll('.dropdown-item');
                            dropdownItems.forEach(function(item) {
                                item.addEventListener('click', function(event) {
                                    // クリックされたアイテムのdata-value属性の値を取得
                                    var selectedValue = event.target.getAttribute('data-value');

                                    // 選択された値を表示する要素にセット
                                    document.getElementById('type').innerText = selectedValue;
                                    document.getElementById('type_name').value = selectedValue;

                                    // ここで選択された値に基づく他のアクションを実行することができます

                                });
                            });
                        });
                    </script> -->

                    <div class="form-group">
                        <label for="image_name">画像</label><br>

                        <input type="file" name="image_name" id="imageElem" multiple accept="image/*" style="display:none" />
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
                        <input type="text" class="form-control" id="model_no" name="model_no" placeholder="型番" value="{{ old('model_no') }}">
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