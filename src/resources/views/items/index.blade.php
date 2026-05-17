@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="items">

    <div class="items__tabs">
        <a class="items__tab {{ $tab !== 'mylist' ? 'items__tab--active' : '' }}"
           href="/?keyword={{ $keyword }}">
            おすすめ
        </a>

        <a class="items__tab {{ $tab === 'mylist' ? 'items__tab--active' : '' }}"
           href="/?tab=mylist&keyword={{ $keyword }}">
            マイリスト
        </a>
    </div>

    <div class="items__list">
        @foreach ($items as $item)
            <a class="item-card" href="/item/{{ $item->id }}">
                <div class="item-card__image-wrap">
                    @if ($item->purchase)
                        <span class="item-card__sold">Sold</span>
                    @endif

                    <img class="item-card__image" src="{{ $item->image }}" alt="{{ $item->name }}">
                </div>

                <p class="item-card__name">{{ $item->name }}</p>
            </a>
        @endforeach
    </div>

</div>
@endsection