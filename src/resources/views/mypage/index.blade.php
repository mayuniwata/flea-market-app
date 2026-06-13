@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@php
use Illuminate\Support\Str;
@endphp

@section('content')

<div class="mypage">

    <div class="mypage__profile">

        <div class="mypage__profile-left">

            <div class="mypage__image">
    @if ($user->profile && $user->profile->image)
        <img
            class="mypage__image-img"
            src="{{ Str::startsWith($user->profile->image, 'storage/')
                ? asset($user->profile->image)
                : asset('storage/' . $user->profile->image) }}"
            alt="{{ $user->name }}"
        >
    @endif
</div>

            <h2 class="mypage__user-name">
                {{ $user->name }}
            </h2>

        </div>

        <a class="mypage__edit-button" href="/mypage/profile">
            プロフィールを編集
        </a>

    </div>

    <div class="mypage__tabs">

        <a
            class="mypage__tab {{ $page === 'sell' ? 'mypage__tab--active' : '' }}"
            href="/mypage?page=sell"
        >
            出品した商品
        </a>

        <a
            class="mypage__tab {{ $page === 'buy' ? 'mypage__tab--active' : '' }}"
            href="/mypage?page=buy"
        >
            購入した商品
        </a>

    </div>

    <div class="mypage__items">

        @foreach ($items as $item)

            <a class="item-card" href="/item/{{ $item->id }}">

                <div class="item-card__image-wrapper">

                    @if ($item->image)
    @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
        <img class="item-card__image" src="{{ $item->image }}" alt="{{ $item->name }}">
    @else
        <img class="item-card__image" src="{{ asset($item->image) }}" alt="{{ $item->name }}">
    @endif
@else
    <div class="item-card__no-image">
        商品画像
    </div>
@endif

                </div>

                <p class="item-card__name">
                    {{ $item->name }}
                </p>

            </a>

        @endforeach

    </div>

</div>

@endsection