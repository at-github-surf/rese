@extends('layouts.header')

@section('title')
<title>店舗評価 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
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
            <div class="storedetail__evaluation">
                <div class="storedetail__stars">
                    <span style="background: linear-gradient(90deg, #e6b422 0%, 
                                                             #e6b422 {{ $star_score / 5 * 100}}%, 
                                                             #ddd {{ $star_score / 5 *100 }}%, 
                                                             #ddd);
                                 -webkit-background-clip: text;
                                 -webkit-text-fill-color: transparent;">
                                 ★★★★★</span> {{ $star_score }}
                </div>
                <div class="storedetail__stars-num">評価数  {{ $evaluations->count() }}</div>
            </div>
            <div class="store-prsnl-evaluation-wrap">
                @foreach ($evaluations as $evaluation)
                    <div class="store-prsnl-evaluation">
                        <div class="store-prsnl-evaluation__title">
                            <div class="store-prsnl-evaluation__title--name">
                                {{ $evaluation->name }}　
                                <span style="background: linear-gradient(90deg, #e6b422 0%, 
                                                             #e6b422 {{ $evaluation->stars / 5 * 100}}%, 
                                                             #ddd {{ $evaluation->stars / 5 *100 }}%, 
                                                             #ddd);
                                 -webkit-background-clip: text;
                                 -webkit-text-fill-color: transparent;">
                                ★★★★★
                                </span>
                            </div>
                            <div>{{ substr($evaluation->updated_at, 0, 10) }}</div>
                        </div>
                        <div class="store-prsnl-evaluation__text">
                            {{ $evaluation->ev_detail }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- storedetail -->
        <div class="evaluation__wrap">
            <div class="evaluation">
                <div class="evaluation__title">店舗を評価する</div>
                <div class="evaluation__form-wrap">
                    <form method="post" action="/detail/evaluation/{{ $store->id }}">
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        <div class="evaluation__form-body">
                            <div class="evaluation__form-items">
                                <div class="evaluation__form-item">
                                    <label for="stars" class="evaluation__form-label">評価</label>
                                    <select name="stars" id="stars" class="evaluation__form-star">
                                        <option value="1">星1つ</option>
                                        <option value="2">星2つ</option>
                                        <option value="3">星3つ</option>
                                        <option value="4">星4つ</option>
                                        <option value="5">星5つ</option>
                                    </select>
                                </div>
                                <div class="evaluation__form-item">
                                    <label for="ev_detail" class="evaluation__form-label">評価詳細</label>
                                    <textarea name="ev_detail" id="ev_detail" class="evaluation__form-detail"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="evaluation__form-submit">
                            <input type="submit" value="評価する" class="evaluation__form-submit-btn" />
                        </div>
                    </form>
                </div><!-- evaluation__form-wrap -->
            </div><!-- evaluation -->
        </div>
    </div>
@endsection