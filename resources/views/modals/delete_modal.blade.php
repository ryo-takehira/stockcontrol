<div class="modal fade" id="itemDeleteModalLabel{{ $item->id }}" tabindex="-1" aria-labelledby="itemDeleteModalLabel{{ $item->id }}" aria-hidden="true">
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
                                        <div class="card-body">
                                            <p class="card-test">備品名:{{ $item->name }}</p><br>
                                            <p class="card-text">保管場所: {{ $item->type }}</p><br>
                                            <p class="card-text">型番・品番: {{ $item->model_no }}</p><br>
                                            <div class="overflow-auto" style="max-height: 200px;">
                                                <p class="card-text">現在の在庫数: {{ $item->stock }}</p><br>
                                                <p class="card-text">在庫単位: {{ $item->stock_unit }}</p><br>

                                                <!-- 削除ボタン -->
                                                <form action="/items/{{$item->id}}/delete" method="POST">
                                                    <p class="card-text delete_message">本当に削除しますか？</p><br>
                                                    {{ csrf_field() }}
                                                    <input type="submit" value="削除する" class="btn btn-danger btn-dell">
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