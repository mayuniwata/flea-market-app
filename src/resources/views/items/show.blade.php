@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

<div class="item-detail">

    <div class="item-detail__image">
        @if (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']))
    <img
        class="item-detail__image"
        src="{{ $item->image }}"
        alt="{{ $item->name }}"
    >
@else
    <img
        class="item-detail__image"
        src="{{ asset($item->image) }}"
        alt="{{ $item->name }}"
    >
@endif
    </div>

    <div class="item-detail__content">

        <h2 class="item-detail__name">
            {{ $item->name }}
        </h2>

        <p class="item-detail__brand">
            {{ $item->brand }}
        </p>

        <p class="item-detail__price">
            ¥{{ number_format($item->price) }}
        </p>

        <div class="item-detail__actions">

    <form
        class="item-detail__like-form"
        action="/item/{{ $item->id }}/like"
        method="post"
    >
        @csrf

        <button
            class="item-detail__like-button"
            type="submit"
        >

            @if($isLiked)

                <img
                    class="item-detail__icon"
                    src="{{ asset('images/ハートロゴ_ピンク.png') }}"
                    alt="liked"
                >

            @else

                <img
                    class="item-detail__icon"
                    src="{{ asset('images/ハートロゴ_デフォルト.png') }}"
                    alt="like"
                >

            @endif

        </button>

        <p class="item-detail__count">
            {{ $item->likes->count() }}
        </p>

    </form>

    <div class="item-detail__comment">

        <img
            class="item-detail__icon"
            src="{{ asset('images/ふきだしロゴ.png') }}"
            alt="comment"
        >

        <p class="item-detail__count">
            {{ $item->comments->count() }}
        </p>

    </div>

</div>
        <a class="item-detail__purchase-button"
           href="/purchase/{{ $item->id }}">
            購入手続きへ
        </a>

        <div class="item-detail__description">
            <h3>商品説明</h3>

            <p>
                {{ $item->description }}
            </p>
        </div>

        <div class="item-detail__info">
            <h3>商品の情報</h3>

            <div class="item-detail__categories">
                @foreach ($item->categories as $category)
                    <span class="item-detail__category">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>

            <p>
                状態：{{ $item->condition }}
            </p>
        </div>
        <div class="item-detail__comments">

    <h3>
        コメント ({{ $item->comments->count() }})
    </h3>

    @foreach ($item->comments as $comment)

        <div class="comment">

            <p class="comment__user">
                {{ $comment->user->name }}
            </p>

            <p class="comment__content">
                {{ $comment->comment }}
            </p>

        </div>

    @endforeach

    @auth

        <form class="comment-form" action="/item/{{ $item->id }}/comment" method="post">

            @csrf

            <label class="comment-form__label">
                商品へのコメント
            </label>

            <textarea class="comment-form__textarea" name="comment">{{ old('comment') }}</textarea>

            @error('comment')
                <p class="comment-form__error">
                    {{ $message }}
                </p>
            @enderror

            <button class="comment-form__button" type="submit">
                コメントを送信する
            </button>

        </form>

    @endauth

</div>

        </div>

    </div>

</div>
@endsection