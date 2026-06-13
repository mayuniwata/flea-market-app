@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<div class="purchase">
    <div class="purchase__left">
        <div class="purchase__item">
            <img class="purchase__image" src="{{ $item->image }}" alt="{{ $item->name }}">

            <div class="purchase__item-info">
                <h2 class="purchase__name">{{ $item->name }}</h2>
                <p class="purchase__price">¥{{ number_format($item->price) }}</p>
            </div>
        </div>

        <form class="purchase-form" action="/purchase/{{ $item->id }}" method="post">
            @csrf

            <div class="purchase-form__group">
                <label class="purchase-form__label">支払い方法</label>

                <select class="purchase-form__select" name="payment_method" id="payment-method-select">
                    <option value="">選択してください</option>
                    <option value="コンビニ支払い">コンビニ支払い</option>
                    <option value="カード支払い">カード支払い</option>
                </select>
            </div>

            <div class="purchase-form__group">
                <div class="purchase-form__heading">
                    <label class="purchase-form__label">配送先</label>
                    <a class="purchase-form__address-link" href="/purchase/address/{{ $item->id }}">変更する</a>
                </div>
                <input
    type="hidden"
    name="postcode"
    value="{{ session('postcode', '〒000-0000') }}"
>

<input
    type="hidden"
    name="address"
    value="{{ session('address', '東京都渋谷区') }}"
>

<input
    type="hidden"
    name="building"
    value="{{ session('building', 'テストマンション101') }}"
>

<p class="purchase-form__address">
    {{ session('postcode', '〒000-0000') }}<br>
    {{ session('address', '東京都渋谷区') }}<br>
    {{ session('building', 'テストマンション101') }}
</p>

                
            </div>

            <div class="purchase__right">
                <div class="purchase__summary">
                    <div class="purchase__summary-row">
                        <p>商品代金</p>
                        <p>¥{{ number_format($item->price) }}</p>
                    </div>

                    <div class="purchase__summary-row">
                        <p>支払い方法</p>
                        <p id="payment-method-text">選択してください</p>
                    </div>
                </div>

                <button class="purchase__button" type="submit">購入する</button>
            </div>
        </form>
    </div>
</div>

<script>
    const select = document.getElementById('payment-method-select');
    const text = document.getElementById('payment-method-text');

    select.addEventListener('change', () => {
        text.textContent = select.value || '選択してください';
    });
</script>

@endsection
