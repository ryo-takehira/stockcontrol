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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">備品名</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="備品名">
                        </div>

                        <div class="form-group">
                            <label for="type">部署</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="部署">
                        </div>

                        <div class="form-group">
                            <label for="image_name">画像</label><br>

                            <input type="file" id="imageElem" multiple accept="image/*" style="display:none" />
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
                            <label for="model_no">型番</label>
                            <input type="text" class="form-control" id="model_no" name="model_no" placeholder="型番">
                        </div>
                        
                        <div class="form-group">
                            <label for="order_name">発注先</label>
                            <input type="text" class="form-control" id="order_name" name="order_name" placeholder="発注先">
                        </div>

                        <div class="form-group">
                            <label for="order_person">発注先担当者</label>
                            <input type="text" class="form-control" id="order_person" name="order_person" placeholder="発注先担当者">
                        </div>

                        <div class="form-group">
                            <label for="order_phone">発注先電話番号</label>
                            <input type="phone" class="form-control" id="order_phone" name="order_phone" placeholder="発注先電話番号">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="在庫数">
                        </div>

                        <div class="form-group">
                            <label for="minimum_stock">最低在庫数</label>
                            <input type="text" class="form-control" id="minimum_stock" name="minimum_stock" placeholder="最低在庫数">
                        </div>

                        <div class="form-group">
                            <label for="order_quantity">発注数</label>
                            <input type="number" class="form-control" id="order_quantity" name="order_quantity" placeholder="発注数">
                        </div>

                        <div class="form-group">
                            <label for="price">単価</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="単価">
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
