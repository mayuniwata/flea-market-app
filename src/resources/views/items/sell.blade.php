@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="sell">

    <h2 class="sell__title">
        商品の出品
    </h2>

    <form
        class="sell-form"
        action="/sell"
        method="post"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="sell-form__group">

            <h3 class="sell-form__heading">
                商品画像
            </h3>

            <label class="sell-form__image-label">

                <span class="sell-form__image-button">
                    画像を選択する
                </span>

                <input
                    class="sell-form__image-input"
                    type="file"
                    name="image"
                >

            </label>

        </div>

        <div class="sell-form__section">

            <h3 class="sell-form__section-title">
                商品の詳細
            </h3>

            <div class="sell-form__group">

                <label class="sell-form__label">
                    カテゴリー
                </label>

                <div class="sell-form__categories">

                    @foreach ($categories as $category)

                        <label class="sell-form__category">

                            <input
                                class="sell-form__category-input"
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                            >

                            <span class="sell-form__category-name">
                                {{ $category->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

            </div>

            <div class="sell-form__group">

                <label class="sell-form__label">
                    商品の状態
                </label>

                <select
                    class="sell-form__select"
                    name="condition"
                >
                    <option value="">選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>

            </div>

        </div>

        <div class="sell-form__section">

            <h3 class="sell-form__section-title">
                商品名と説明
            </h3>

            <div class="sell-form__group">

                <label class="sell-form__label">
                    商品名
                </label>

                <input
                    class="sell-form__input"
                    type="text"
                    name="name"
                >

            </div>

            <div class="sell-form__group">

                <label class="sell-form__label">
                    ブランド名
                </label>

                <input
                    class="sell-form__input"
                    type="text"
                    name="brand"
                >

            </div>

            <div class="sell-form__group">

                <label class="sell-form__label">
                    商品の説明
                </label>

                <textarea
                    class="sell-form__textarea"
                    name="description"
                ></textarea>

            </div>

            <div class="sell-form__group">

    <label class="sell-form__label">
        販売価格
    </label>

    <div class="sell-form__price">

        <span class="sell-form__yen">
            ¥
        </span>

        <input
            class="sell-form__input sell-form__price-input"
            type="number"
            name="price"
        >

    </div>

</div>

        </div>

        <button
            class="sell-form__button"
            type="submit"
        >
            出品する
        </button>

    </form>

</div>

@endsection