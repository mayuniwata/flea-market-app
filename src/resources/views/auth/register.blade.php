@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <h2 class="register__title">会員登録</h2>

    <form class="register-form" action="/register" method="post">
        @csrf

        <div class="register-form__group">
            <label class="register-form__label">ユーザー名</label>
            <input class="register-form__input" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="register-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="register-form__group">
            <label class="register-form__label">メールアドレス</label>
            <input class="register-form__input" type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="register-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="register-form__group">
            <label class="register-form__label">パスワード</label>
            <input class="register-form__input" type="password" name="password">
            @error('password')
                <p class="register-form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="register-form__group">
            <label class="register-form__label">確認用パスワード</label>
            <input class="register-form__input" type="password" name="password_confirmation">
        </div>

        <button class="register-form__button" type="submit">
            登録する
        </button>
    </form>

    <div class="register__link-wrap">
        <a class="register__link" href="/login">ログインはこちら</a>
    </div>
</div>
@endsection