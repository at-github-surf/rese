@extends('layouts.header')

@section('title')
<title>予約変更 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css') }}">
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
                    <li class="hamburger__item"><a href="/mypage">Mypage</a></li>
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
    <div class="content__wrapper">
        <div class="storedetail">
            <div class="storedetail__title-wrapper">
                <div class="storedetail__title-ico">
                    <a href="" onclick="history.back()" class="storedetail__title-ico-back"><</a>
                </div>
                <h3 class="storedetail__name">{{ $store->name }}</h3>
            </div>
            <figure class="storedetail__img-wrapper">
                <img class="storedetail__img" src="{{ config('rese.img_path') }}{{ $store->image_url }}" alt="{{ $store->name }}">
            </figure>
            <div class="storedetail__tag">
                #{{ $store->area }} #{{ $store->genre }}
            </div>
            <div class="storedetail__text">
                {{ $store->detail }}
            </div>

        </div><!-- storedetail -->
        <div class="storereserve__wrap">
            <div class="storereserve">
                <div class="storereserve__title">予約変更</div>
                <div class="storereserve__form-wrap">
                    <form method="post" action="/reserve/change/{{ $reserve->id }}">
                        @csrf
                        <div class="storereserve__form-body">
                            <input name="reserve_date" type="date" class="storereserve__form-date"></input>
                            @error('reserve_date')
                            <br><strong class="form__error">{{ $message }}</strong>
                            @enderror
                            <select name="reserve_time" class="storereserve__form-input">
                                <option value="18:00">18:00</option><option value="18:15">18:15</option>
                                <option value="18:30">18:30</option><option value="18:45">18:45</option>
                                <option value="19:00">19:00</option><option value="19:15">19:15</option>
                                <option value="19:30">19:30</option><option value="19:45">19:45</option>
                                <option value="20:00">20:00</option><option value="20:15">20:15</option>
                                <option value="20:30">20:30</option><option value="20:45">20:45</option>
                            </select>
                            <select name="number" class="storereserve__form-input">
                                <option value="1">1人</option><option value="2">2人</option>
                                <option value="3">3人</option><option value="4">4人</option>
                                <option value="5">5人</option><option value="6">6人</option>
                            </select>
                        </div>
                        <div class="storereserve__form-submit">
                            <input type="submit" value="変更する" class="storereserve__form-submit-btn" />
                        </div>
                    </form>
                </div><!-- storereserve__form-wrap -->
            </div><!-- storereserve -->
            <div class="storereserved">
                <div class="storereserved__title">予約内容</div>
                <div class="storereserved__conf">
                    <ul class="storereserved__conf-list">
                        <li>
                            <span class="storereserve__conf-item-name">Date</span>
                            <span class="storereserve__conf-item">{{ $reserve->reserve_date }}</span>
                        </li>
                        <li>
                            <span class="storereserve__conf-item-name">Time</span>
                            <span class="storereserve__conf-item">{{ substr($reserve->reserve_time, 0, 5) }}</span>
                        </li>
                        <li>
                            <span class="storereserve__conf-item-name">Number</span>
                            <span class="storereserve__conf-item">{{ $reserve->number }}人</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection