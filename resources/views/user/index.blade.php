@extends('adminlte::page')



@section('title', 'ユーザー管理')

@section('content_header')
<div class="d-flex">
    <h4 class="titlename">ユーザー管理</h4>

    @if(session('usersuccess'))
    <div id="successMessage" class="custom-message">
        {{ session('usersuccess') }}
    </div>
    @endif

</div>
@stop

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <!-- 検索窓 -->
            <div class="mb-2">
                <div class="d-flex">
                    <form class="d-flex text-align-center" action="{{ url('/users/usersearch') }}" method="get">
                        @csrf
                        <input class="search-window" type="text" name="usersearch" placeholder="検索キーワード" value=''>
                        <button type="submit" class="search-button ms-4">検索</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive p-0">
                <table class="table text-center text-nowrap">
                    <colgroup span="2"></colgroup>
                    <thead>
                        <tr>
                            <th class="fixed02">ID</th>
                            <th class="fixed01">ユーザー名</th>
                            <th class="fixed02">メールアドレス</th>
                            <th class="fixed02">所属部署</th>
                            <th class="fixed02">権限</th>
                            <th class="fixed02">登録日時</th>
                            <th class="fixed02">更新日時</th>
                            <th class="fixed02 column_operation" colspan="2" scope="colgroup">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="align-middle">{{ $user->id }}</td>
                            <td class="align-middle fixed02">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">{{ $user->user_type }}</td>

                            <!-- 管理者権限条件分岐 -->
                            @if($user->isAdmin==10)
                            <td class="align-middle"></td>
                            @elseif($user->isAdmin==1)
                            <td class="align-middle">master</td>
                            @elseif($user->isAdmin==2)
                            <td class="align-middle">事務所</td>
                            @elseif($user->isAdmin==3)
                            <td class="align-middle">CAD室</td>
                            @elseif($user->isAdmin==4)
                            <td class="align-middle">第一工場</td>
                            @elseif($user->isAdmin==5)
                            <td class="align-middle">第二工場</td>
                            @elseif($user->isAdmin==6)
                            <td class="align-middle">第三工場</td>
                            @elseif($user->isAdmin==7)
                            <td class="align-middle">第四工場</td>
                            @elseif($user->isAdmin==8)
                            <td class="align-middle">発送</td>
                            @endif

                            <td class="align-middle">{{ $user->created_at}}</td>
                            <td class="align-middle">{{ $user->updated_at}}</td>

                            @if($user->id!=$auth_user->id)
                            <div class="align-middle">
                                <td class="align-middle">
                                    <!-- 編集ボタン -->
                                    <a href="{{ url('/users/'. $user->id .'/edit') }}" class="btn btn-warning">編集</a>
                                </td>
                                @else
                                <td class="align-middle">
                                    <!-- 編集ボタン無し -->
                                </td>
                                @endif

                                @if($user->id!=$auth_user->id)
                                <div class="align-middle">
                                    <td class="align-middle">
                                        <!-- 削除ボタン -->
                                        <form action="/users/{{$user->id}}/delete" method="POST">
                                            {{ csrf_field() }}
                                            <input type="submit" value="削除" class="btn btn-danger btn-dell">
                                        </form>
                                    </td>
                                    @else
                                    <td class="align-middle">
                                        <!-- 削除ボタン無し -->
                                    </td>
                                    @endif
                                </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="page-link">
                <div class="row">
                    <div class="col-6">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-5')}}
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

@stop

@section('css')
<!-- オリジナルstylecssファイル -->
<link href="{{ asset('/css/item.css') }}" rel="stylesheet">
@stop

@section('js')
@stop