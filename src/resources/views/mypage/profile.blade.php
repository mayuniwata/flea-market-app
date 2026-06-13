@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@php
use Illuminate\Support\Str;
@endphp

@section('content')

<div class="profile-edit">

    <h2 class="profile-edit__title">
        プロフィール設定
    </h2>

    <form class="profile-form" action="/mypage/profile" method="post" enctype="multipart/form-data">

        @csrf

        <div class="profile-form__image-area">

            @if(optional($profile)->image)
                <img
                    class="profile-form__image"
                    src="{{ Str::startsWith($profile->image, 'storage/')
    ? asset($profile->image)
    : asset('storage/' . $profile->image) }}"
                    alt="プロフィール画像"
                >
            @else
                <div class="profile-form__image-placeholder"></div>
            @endif

            <label class="profile-form__image-button">
                画像を選択する
                <input
                    class="profile-form__image-input"
                    type="file"
                    name="image"
                >
            </label>

        </div>

        <div class="profile-form__group">
            <label class="profile-form__label">ユーザー名</label>
            <input
                class="profile-form__input"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
            >
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label">郵便番号</label>
            <input
                class="profile-form__input"
                type="text"
                name="postcode"
                value="{{ old('postcode', optional($profile)->postcode) }}"
            >
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label">住所</label>
            <input
                class="profile-form__input"
                type="text"
                name="address"
                value="{{ old('address', optional($profile)->address) }}"
            >
        </div>

        <div class="profile-form__group">
            <label class="profile-form__label">建物名</label>
            <input
                class="profile-form__input"
                type="text"
                name="building"
                value="{{ old('building', optional($profile)->building) }}"
            >
        </div>

        <button class="profile-form__button" type="submit">
            更新する
        </button>

    </form>

</div>

@endsection