<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Prefecture;
use App\Models\Favorite;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = $this->searchShops($request);
        $prefectures = Prefecture::all();
        $genres = Genre::all();
        $favorites = $this->getFavorites();

        return view('index', compact('shops', 'prefectures', 'genres', 'favorites'));
    }

    public function search(Request $request)
    {
        $shops = $this->searchShops($request);
        $favorites = $this->getFavorites();
        $isLoggedIn = Auth::check();

        return response()->json([
            'shops' => $shops,
            'isLoggedIn' => $isLoggedIn,
            'favorites' => $favorites,
        ]);
    }
    private function searchShops(Request $request): \Illuminate\Support\Collection
    {
        $prefecture = $request->input('prefecture');
        $genre = $request->input('genre');
        $word = $request->input('word');
        $sort = $request->input('sort');

        $query = Shop::with(['prefecture', 'genre'])
            ->when($prefecture, function ($query) use ($prefecture) {
                return $query->where('prefecture_id', $prefecture);
            })
            ->when($genre, function ($query) use ($genre) {
                return $query->where('genre_id', $genre);
            })
            ->when($word, function ($query) use ($word) {
                return $query->where('name', 'like', '%' . $word . '%');
            });

        return $query->get();
    }

    private function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->pluck('shop_id')->toArray();
        }
        return [];
    }

    public function detail(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $shop = Shop::find($request->shop_id);
        $from = $request->input('from');

        $backRoute = '/';
        switch ($from) {
            case 'index':
                $backRoute = '/';
                break;
            case 'mypage':
                $backRoute = '/mypage';
                break;
        }

        return view('detail', compact('user', 'shop', 'backRoute'));
    }
}
