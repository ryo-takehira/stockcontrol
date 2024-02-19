@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('登録') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ユーザー名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード(確認用)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('所属部署') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="user_type" id="user_type" required placeholder="部署">
                                    <option value="" {{ old('user_type') == '' ? 'selected' : '' }}>>選択してください</option>
                                    <option value="営業" {{ old('user_type') == '営業' ? 'selected' : '' }}>営業</option>
                                    <option value="事務" {{ old('user_type') == '事務' ? 'selected' : '' }}>事務</option>
                                    <option value="CAD" {{ old('user_type') == 'CAD' ? 'selected' : '' }}>CAD</option>
                                    <option value="第一工場" {{ old('user_type') == '第一工場' ? 'selected' : '' }}>第一工場</option>
                                    <option value="第二工場" {{ old('user_type') == '第二工場' ? 'selected' : '' }}>第二工場</option>
                                    <option value="第三工場" {{ old('user_type') == '第三工場' ? 'selected' : '' }}>第三工場</option>
                                    <option value="第四工場" {{ old('user_type') == '第四工場' ? 'selected' : '' }}>第四工場</option>
                            </div>
                            </select>
                        </div>

                        <div class="row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection