@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address">
    <h2 class="address__title">住所の変更</h2>

    <form class="address-form" action="/purchase/address/{{ $item->id }}" method="post">
        @csrf

        <div class="address-form__group">
            <label class="address-form__label">郵便番号</label>
            <input class="address-form__input" type="text" name="postcode" value="{{ old('postcode', '000-0000') }}">
        </div>

        <div class="address-form__group">
            <label class="address-form__label">住所</label>
            <input class="address-form__input" type="text" name="address" value="{{ old('address', '東京都渋谷区') }}">
        </div>

        <div class="address-form__group">
            <label class="address-form__label">建物名</label>
            <input class="address-form__input" type="text" name="building" value="{{ old('building', 'テストマンション101') }}">
        </div>

        <button class="address-form__button" type="submit">
            更新する
        </button>
    </form>
</div>
@endsection