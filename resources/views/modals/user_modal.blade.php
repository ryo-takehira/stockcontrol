<div class="modal fade" id="userDeleteModalLabel{{ $user->id }}" tabindex="-1" aria-labelledby="userDeleteModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <div class="card-body" style="overflow:auto">
                                            <h4 class="card-test">ユーザー情報</h4><br>
                                            <p class="card-test">ID:{{ $user->id }}</p><br>
                                            <p class="card-test">ユーザー名:{{ $user->name }}</p><br>
                                            <p class="card-test">メールアドレス:{{ $user->email }}</p><br>
                                            <p class="card-text">所属部署: {{ $user->user_type }}</p><br>

                                            <!-- 管理者権限条件分岐 -->
                                            @if($user->isAdmin==10)
                                            <p class="card-text">権限:</p><br>
                                            @elseif($user->isAdmin==1)
                                            <p class="card-text">権限:master</p><br>
                                            @elseif($user->isAdmin==2)
                                            <p class="card-text">権限:事務所</p><br>
                                            @elseif($user->isAdmin==3)
                                            <p class="card-text">権限:CAD室</p><br>
                                            @elseif($user->isAdmin==4)
                                            <p class="card-text">権限:第一工場</p><br>
                                            @elseif($user->isAdmin==5)
                                            <p class="card-text">権限:第二工場</p><br>
                                            @elseif($user->isAdmin==6)
                                            <p class="card-text">権限:第三工場</p><br>
                                            @elseif($user->isAdmin==7)
                                            <p class="card-text">権限:第四工場</p><br>
                                            @elseif($user->isAdmin==8)
                                            <p class="card-text">権限:発送</p><br>
                                            @endif

                                            <div class="overflow-auto" style="max-height: 200px;">


                                                <form action="/users/{{$user->id}}/delete" method="POST">
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