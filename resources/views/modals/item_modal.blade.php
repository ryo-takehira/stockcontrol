<div class="modal fade" id="itemModalLabel{{ $item->id }}" tabindex="-1" aria-labelledby="itemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <img src="{{$item->image_name}}" class="img-fluid" alt="...">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body" style="overflow:auto">
                                            <p class="card-test">備品名:{{ $item->name }}</p><br>
                                            <p class="card-text">保管場所: {{ $item->type }}</p><br>
                                            <p class="card-text">型番・品番: {{ $item->model_no }}</p><br>
                                            <div class="overflow-auto" style="max-height: 200px;">
                                                <p class="card-text">現在の在庫数: {{ $item->stock }}</p><br>
                                                <p class="card-text">在庫単位: {{ $item->stock_unit }}</p><br>
                                                <!-- 持出ボタン -->
                                                <form action="/items/{{$item->id}}/take_out" method="POST">
                                                    <div class="form-group d-flex">
                                                        <label for="order_name" class="mr-3 mt-2">持出数量</label>
                                                        <input type="number" class="form-control" id="take_out" name="take_out" required value="" min="0" placeholder="〇{{ $item->stock_unit }}">
                                                    </div>
                                                        {{ csrf_field() }}
                                                        <input type="submit" value="持ち出す" class="btn btn-primary">
                                                </form>
                                            




                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
    </div>
</div>
</div>