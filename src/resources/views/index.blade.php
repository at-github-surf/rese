@extends('layouts.header_search')

@section('title')
<title>店舗一覧 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header_hamburger')
<!-- ハンバーガーメニューボタン -->
<div class="hamburger">
    <input type="checkbox" id="menu-btn-check">
    <nav class="hamburger__menu">
        @if(isset($user))
        <ul class="hamburger__list">
            <li class="hamburger__item"><a href="/">Home</a></li>
            <li class="hamburger__item">
                <form action="/logout" method="POST" class="hamburger__logout">
                    @csrf
                    <button type="submit" class="hamburger__logout-btn">logout</button>
                </form>
            </li>
            @if($user->auth_id == 0)
            <li class="hamburger__item"><a href="/mypage">Mypage</a></li>
            @endif
            @if($user->auth_id == 1)
            <li class="hamburger__item"><a href="/siteadmin">ManageStoremanager</a></li>
            @endif
            @if($user->auth_id == 2)
            <li class="hamburger__item"><a href="/storemanage">ManageStoreInfo</a></li>
            @endif
        </ul>
        @else
        <ul class="hamburger__list">
            <li class="hamburger__item"><a href="/">Home</a></li>
            <li class="hamburger__item"><a href="/register">Registration</a></li>
            <li class="hamburger__item"><a href="/login">Login</a></li>
        </ul>
        @endif
    </nav>
    <label for="menu-btn-check" class="hamburger__button">
        <span></span>
        </labe>
</div>
@endsection

@section('header_func_search')
<div class="header__search">
    <form action="/" method="POST" class="header__searchform">
        @csrf
        <select name="area" type="submit" class="header__pulldown">
            <option value="0">All area</option>
            @foreach ($areas as $area)
            @if( isset($lasttime_v) && ($area->id == $lasttime_v->area) )
            <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
            @else
            <option value="{{ $area->id }}">{{ $area->area }}</option>
            @endif
            @endforeach
        </select>
        <select name="genre" type="submit" class="header__pulldown">
            <option value="0">All genre</option>
            @foreach ($genres as $genre)
            @if( isset($lasttime_v) && ($genre->id == $lasttime_v->genre) )
            <option value="{{ $genre->id }}" selected>{{ $genre->genre }}</option>
            @else
            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
            @endif
            @endforeach
        </select>
        @if( isset($lasttime_v->searchword) )
        <input name="searchword" class="header__input" type="text" id="searchword" value="{{ $lasttime_v->searchword }}" />
        @else
        <input name="searchword" class="header__input" type="text" id="searchword" placeholder="Search ..." />
        @endif
        <button type="submit">検索</button>
    </form>
</div>
@endsection


@section('content')
<div class="storeindex__wrapper">
    @if( isset($user->auth_id) )
        @if( $user->auth_id == 1 )
        <div class="managefunc__wrapper">
            <div class="managefunc__btn">
                <a class="managefunc__btn--lable" href="/siteadmin">店舗代表者管理ページへ</a>
            </div>
        </div>
        @endif
        @if( $user->auth_id == 2 )
        <div class="managefunc__wrapper">
            <div class="managefunc__btn">
                <a class="managefunc__btn--lable" href="/storemanage">店舗情報管理ページへ</a>
            </div>
        </div>
        @endif
    @endif
    <div class="storecards storecards--col4">

        @foreach ($stores as $store)
        <div class="storecards__item storecard">
            <figure class="storecard__img-wrapper">
                <img class="storecard__img" src="{{ config('rese.img_path') }}{{ $store->image_url }}" alt="">
            </figure>
            <div class="storecard__body">
                <h3 class="storecard__name">{{ $store->name }}</h3>
                <div class="storecard__tag">
                    #{{ $store->area }} #{{ $store->genre }}
                </div>
                <div class="storecard__stars">
                    <span style="background: linear-gradient(90deg, #e6b422 0%, 
                                                             #e6b422 {{ $store->stars / 5 * 100}}%, 
                                                             #ddd {{ $store->stars / 5 *100 }}%, 
                                                             #ddd);
                                             -webkit-background-clip: text;
                                             -webkit-text-fill-color: transparent;">
                        ★★★★★
                    </span>
                </div>
                <div class="storecard__func">
                    <div class="storecard__btn-detail">
                        <a class="storecard__btn-label" href="detail/{{ $store->id }}">詳しくみる</a>
                    </div>
                    @if( is_null($store->flag_favo) )
                    <a class="storecard__favo-link" href="favorite/{{ $store->id }}">
                        <span class="storecard__favo-off">&#9829;</span>
                    </a>
                    @else
                    <a class="storecard__favo-link" href="favorite/{{ $store->id }}">
                        <span class="storecard__favo-on">&#9829;</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>
@endsection