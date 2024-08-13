@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage_user.css') }}">
<link rel="stylesheet" href="{{ asset('css/partials.css') }}">
@endsection

@section('content')
@include('mypage.partials.user',[
'reservations'=>$reservations,
'shops'=>$shops
])
<script src="{{ asset('js/reservation.js') }}"></script>
@endsection