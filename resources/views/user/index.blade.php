@extends('adminlte::page')



@section('title', 'ユーザー管理')

@section('content_header')
    <div class="d-flex">
    <h1 class="titlename">ユーザー管理</h1>
    @if(session('success'))
    <div id="successMessage" class="custom-message">
        {{ session('success') }}
    </div>
    @endif
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ユーザー管理</h3>

                </div>
                <div class="table-responsive p-0">
                    <table class="table text-center text-nowrap">
                    <colgroup span="2"></colgroup>
                        <thead>
                            <tr>
                                <th class="fixed02">ID</th>
                                <th class="fixed01">ユーザー名</th>
                                <th class="fixed02">メールアドレス</th>
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
                                    <td class="align-middle">{{ $user->isAdmin }}</td>
                                    <td class="align-middle">{{ $user->created_at}}</td>
                                    <td class="align-middle">{{ $user->updated_at}}</td>
                                    <div class="align-middle">
                                    <td class="align-middle">
                                        <!-- 編集ボタン -->
                                        <a href="{{ url('/users/'. $user->id .'/edit') }}" class="btn btn-warning">編集</a>
                                    </td>
                                    <td class="align-middle">
                                        <!-- 削除ボタン -->
                                        <form action="/users/{{$user->id}}/delete" method="POST">
                                            {{ csrf_field() }}
                                            <input type="submit" value="削除" class="btn btn-danger btn-dell">
                                        </form>
                                    </td>
                                    <td class="align-middle">
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