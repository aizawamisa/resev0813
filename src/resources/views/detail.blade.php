@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detail__wrap">
    <div class="detail__header">
        <div class="header__title">
            <a href="{{ $backRoute }}" class="header__back">
                &lt;&lt;</a>
            <span class="header__shop-name">{{ $shop->name }}</span>
        </div>
    </div>
    <div class="detail__image">
        <img src="{{ $shop->image_url }}" alt="イメージ画像" class="detail__image-img">
    </div>
    <div class="detail__tag">
        <p class="detail__tag-info">#{{ $shop->prefecture->name }}</p>
        <p class="detail__tag-info">#{{ $shop->genre->name }}</p>
    </div>
    <div class="detail__summary">
        <p class="detail__summary-text">{{ $shop->summary }}</p>
    </div>
</div>

<form action="{{ route('reservation', $shop) }}" method="post" class="reservation__wrap">
    @csrf
    <div class="reservation__content">
        <p class="reservation__title">予約</p>
        <div class="form__content">
            <input type="date" id="datePicker" class="form__item" name="date" value="{{ $reservation->date ?? '' }}">
            <script>
                window.onload = function() {
                    var today = new Date().toISOString().split('T')[0];
                    document.getElementById("datePicker").setAttribute('min', today);
                };
            </script>
            <div class="error__item">
                @error('date')
                <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <select name="time" class="form__item">
                <option value="" selected disabled>-- 時間を選択してください --</option>
                @foreach (['20:00', '20:30', '21:00', '21:30', '22:00'] as $time)
                <option value="{{ $time }}" {{ isset($reservation->time) && $reservation->time == $time ? 'selected' : '' }}>
                    {{ $time }}
                </option>
                @endforeach
            </select>
            <div class="error__item">
                @error('time')
                <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <select name="number" class="form__item">
                <option value="" selected disabled>-- 人数を選択してください --</option>
                @foreach (range(1, 5) as $number)
                <option value="{{ $number }}" {{ isset($reservation->number) && $reservation->number == $number ? 'selected' : '' }}>
                    {{ $number }}人
                </option>
                @endforeach
            </select>
            <div class="error__item">
                @error('number')
                <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="reservation__group">
            <div class="reservation__area">
                <table class="reservation__table">
                    <tr>
                        <th class="table__header">Shop</th>
                        <td class="table__item">{{ $shop->name }}</td>
                    </tr>
                    <tr>
                        <th class="table__header">Date</th>
                        <td class="table__item">
                            {{ $reservation->date ?? '未選択' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="table__header">Time</th>
                        <td class="table__item">
                            {{ $reservation->time ?? '未選択' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="table__header">Number</th>
                        <td class="table__item">
                            {{ $reservation->number ?? '未選択' }}人
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="reservation__button">
        @if (Auth::check())
        <button type="submit" class="reservation__button-btn" onclick="return confirmReservation()">予約する</button>
        @else
        <button type="button" class="reservation__button-btn--disabled" disabled>予約は<a href="/register" class="reservation__button-link">会員登録</a><a href="/login" class="reservation__button-link">ログイン</a>が必要です</button>
        @endif
    </div>
</form>

<script src="{{ asset('js/detail.js') }}"></script>
<script src="{{ asset('js/reservation.js') }}"></script>

@endsection