@extends('layouts.app')

@section('content')
    <h1>{{ $shop->name }}</h1>
    <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}" class="img-fluid">
    <p>{{ $shop->summary }}</p>
    <h3>予約する</h3>
    @auth
        <form action="{{ route('reservation.store', $shop) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">予約日</label>
                <input type="datetime-local" id="date" name="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label">人数</label>
                <input type="number" id="number" name="number" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">予約する</button>
        </form>
    @else
        <p>予約するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
    @endauth
@endsection
