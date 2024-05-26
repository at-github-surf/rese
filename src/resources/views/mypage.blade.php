@extends('layouts.header')

@section('title')
<title>マイページ | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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

@section('content')
    <div class="maypage__wrapper">
        <div class="reserved__wrapper">
            <h2 class="reserved__title">予約状況</h2>
            <div class="reserved__stores">

                @if( isset($reserves) )
                @foreach( $reserves as $reserve)
                    @if( $reserve->reserve_date >= date('Y-m-d') )
                            <div class="storereserved">
                    @else
                            <div class="storereserved-p">
                    @endif
                        @if( $reserve->reserve_date >= date('Y-m-d') )
                            <div class="storereserved__title">予約{{ $loop->iteration }}</div>
                        @else
                            <div class="storereserved__title">予約履歴</div>
                        @endif
                        <div class="storereserved__conf">
                            <div class="storereserved__conf-lists-wrap">
                            <ul class="storereserved__conf-lists">
                                <li>
                                    <span class="storereserve__conf-item-name">Shop</span>
                                    <span class="storereserve__conf-item">{{ $reserve->name }}</span>
                                </li>
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
                            @if( $reserve->reserve_date >= date('Y-m-d') )
                            <div class="storereserved__QR-wrap">
                                {!! $reserve->QR !!}
                            </div>
                            @endif
                        </div>
                        @if( $reserve->reserve_date >= date('Y-m-d') )
                            <div class="storereserved__func">
                                <div class="storereserved__edit">
                                    <form method="get" action="/reserve/change/{{ $reserve->id }}">
                                        <input type="submit" value="変更" class="storereserved__edit-btn" />
                                    </form>
                                </div>
                                <div class="storereserved__cnacel">
                                    <form method="get" action="/reserve/cancel/{{ $reserve->id }}">
                                        <input type="submit" value="キャンセル" class="storereserved__cnacel-btn" />
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div><!-- storereserved -->
                @endforeach
                @else
                    予約なし
                @endif
            </div>

        </div><!-- reserved__wrapper -->
        <div class="storeindex__wrapper">
            <div class="myname">{{ $user->name }}さん</div>
            <div class="favorite-title">お気に入り店舗</div>
            <div class="storecards storecards--col4">
                @foreach($stores as $store)
                <div class="storecards__item storecard">
                    <figure class="storecard__img-wrapper">
                        <img class="storecard__img" 
                        src="{{ config('rese.img_path') }}{{ $store->image_url }}" alt="{{ $store->name }}">
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
                                <a class="storecard__btn-label" href="/detail/{{ $store->id }}">詳しくみる</a>
                            </div>
                            <a class="storecard__favo-link" href="favorite/{{ $store->id }}">
                                <span class="storecard__favo-on">&#9829;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach




            </div>
        </div><!-- storeindex__wrapper -->
    </div>
@endsection