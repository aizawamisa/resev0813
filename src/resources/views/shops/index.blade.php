@extends('layouts.app')

@section('content')
    <h1>レストラン一覧</h1>
    @foreach ($shops as $shop)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $shop->name }}</h5>
                <p class="card-text">{{ $shop->summary }}</p>
                <a href="{{ route('shops.show', $shop) }}" class="btn btn-primary">詳細を見る</a>
                @auth
                    <form action="{{ route('favorite.store', $shop) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">お気に入りに追加</button>
                    </form>
                @endauth
            </div>
        </div>
    @endforeach
@endsection
