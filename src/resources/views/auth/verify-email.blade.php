@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')

<div class="verify-email">
    <h2 class="verify-email__title">メール認証が必要です</h2>

    <p class="verify-email__text">
        登録していただいたメールアドレスに認証メールを送付しました。<br>
    メール認証を完了してください。
    </p>

    <a class="verify-email__link" href="http://localhost:8025" target="_blank">
        認証はこちらから
    </a>

    @if (session('message'))
        <p class="verify-email__message">{{ session('message') }}</p>
    @endif

    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button class="verify-email__button" type="submit">
            認証メールを再送する
        </button>
    </form>
</div>

@endsection