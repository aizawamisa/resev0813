<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function index()
    {
        $reservations = $this->getReservations();

        $favorites = Auth::user()->favorites()
            ->pluck('shop_id')
            ->toArray();

        $shops = Shop::with(['prefecture', 'genre'])
            ->whereIn('id', $favorites)
            ->get();

        $user = Auth::user();

        $viewData = [
            'user' => $user,
            'reservations' => $reservations,
            'favorites' => $favorites,
            'shops' => $shops
        ];

        return view('mypage.dashboard', $viewData);
    }

    private function getReservations()
    {
        return Auth::user()->reservations()
            ->with('shop')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
    }
}
