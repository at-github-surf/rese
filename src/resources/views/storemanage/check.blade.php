@extends('layouts.header')

@section('title')
<title>来店確認 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/storemanage/check.css') }}">
@endsection

@section('header_hamburger')
    <!-- ハンバーガーメニューボタン -->
    <div class="hamburger">
        <input type="checkbox" id="menu-btn-check">
        <nav class="hamburger__menu">
            <ul class="hamburger__list">
                <li class="hamburger__item"><a href="/">Home</a></li>
                <li class="hamburger__item">
                    <form action="/logout" method="POST" class="hamburger__logout">
                        @csrf
                        <button type="submit" class="hamburger__logout-btn">logout</button>
                    </form>
                </li>
            </ul>
        </nav>
        <label for="menu-btn-check" class="hamburger__button">
            <span></span>
        </labe>
    </div>
@endsection

@section('header_func_multibtn')

@endsection

@section('content')
    <div class="dialog__wrapper">
        <div class="dialog__outer">
            <div class="dialog__inner">
                <div class="dialog__title">
                    Check-in
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <ul class="reserveData">
                    <li class="reserveData__item">
                        <span class="reserveData__item-label">Name</span><span>{{ $reserve->name }}様</span>
                    </li>
                    <li class="reserveData__item">
                        <span class="reserveData__item-label">Date</span><span>{{ $reserve->reserve_date }}</span>
                    </li>
                    <li class="reserveData__item">
                        <span class="reserveData__item-label">Time</span><span>{{ substr($reserve->reserve_time, 0, 5) }}</span>
                    </li>
                    <li class="reserveData__item">
                        <span class="reserveData__item-label">Number</span><span>{{ $reserve->number }}名様</span>
                    </li>
                </ul>
                <form method="post" action="/storemanage/check/{{ $reserve->store_id }}/{{ $reserve->id }}" class="confirm">
                    @csrf
                    <div class="confirm__submit">
                        <button class="confirm__btn-submit" type="submit">入店確認</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection