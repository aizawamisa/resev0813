@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<form class="header__right" action="/" method="get">
    <div class="header__search">
        <label class="select-box__label">
            <select name="prefecture" class="select-box__item">
                <option value="">All prefecture</option>
                @foreach ($prefectures as $prefecture)
                <option class="select-box__option" value="{{ $prefecture->id }}" {{ request('prefecture') == $prefecture->id ? 'selected' : '' }}>{{ $prefecture->name }}
                </option>
                @endforeach
            </select>
        </label>

        <label class="select-box__label">
            <select name="genre" class="select-box__item">
                <option value="">All genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
        </label>

        <div class="search__item">
            <div class="search__item-button"></div>
            <label class="search__item-label">
                <input type="text" name="word" class="search__item-input" placeholder="Search ..." value="{{ request('word') }}">
            </label>
        </div>
    </div>
</form>
@endsection

@section('content')
<div class="shop__wrap">
    @foreach ($shops as $shop)
    <div class="shop__content">
        <img class="shop__image" src="{{ $shop->image_url }}" alt="イメージ画像">
        <div class="shop__item">
            <span class="shop__title">{{ $shop->name }}</span>
            <div class="shop__tag">
                <p class="shop__tag-info">#{{ $shop->prefecture->name }}</p>
                <p class="shop__tag-info">#{{ $shop->genre->name }}</p>
            </div>
            <div class="shop__button">
                <a href="/detail/{{ $shop->id }}?from=index" class="shop__button-detail">詳しくみる</a>
                @if (Auth::check())
                @if (in_array($shop->id, $favorites))
                <form action="{{ route('unfavorite', $shop) }}" method="post" enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                    @csrf
                    @method('delete')
                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                        <img class="favorite__btn-image" src="{{ asset('images/heart_color.png') }}">
                    </button>
                </form>
                @else
                <form action="{{ route('favorite', $shop) }}" method="post" enctype="application/x-www-form-urlencoded" class="shop__button-favorite form">
                    @csrf
                    <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                        <img class="favorite__btn-image" src="{{ asset('images/heart.png') }}">
                    </button>
                </form>
                @endif
                @else
                <button type="button" onclick="location.href='/login'" class="shop__button-favorite-btn">
                    <img class="favorite__btn-image" src="{{ asset('images/heart.png') }}">
                </button>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    @for ($i = 0; $i < 4; $i++) <div class="shop__content dummy">
</div>
@endfor

</div>
<script src="{{ asset('js/search_index.js') }}"></script>
@endsection