@extends('layouts.header')

@section('title')
    <title>店舗詳細 | {{ $store->name }} | rese</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <script defer src="{{ asset('js/reservecopy.js') }}"></script>
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

@section('header_func_multibtn')
@if( $flag_visited && !$flag_evaluation )
    <div class="multibtn">
        <a href="/detail/evaluation/{{ $store->id }}" class="multibtn__label">
        評価する
        </a>
    </div>
@endif
@endsection

@section('content')
    <div class="content__wrapper">
        <div class="storedetail">
            <div class="storedetail__title-wrapper">
                <div class="storedetail__title-ico">
                    <a href="/back" class="storedetail__title-ico-back"><</a>
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
                <div class="storedetail__stars-num">評価数 {{ $evaluations->count() }}</div>
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
        <div class="storereserve__wrap">
            <div class="storereserve">
                <div class="storereserve__title">予約</div>
                <div class="storereserve__form-wrap">
                    @if( is_null($user) )
                        <form method="get" action="/register">
                    @else
                        <form method="post" action="/reserve/{{ $store->id }}">
                    @endif
                        @csrf
                        <div class="storereserve__form-body">
                            <input name="reserve_date" id="reserve_date" type="date" class="storereserve__form-date"></input>
                            @error('reserve_date')
                            <br><strong class="form__error">{{ $message }}</strong>
                            @enderror
                            <select name="reserve_time" id="reserve_time" class="storereserve__form-input">
                                <option value="18:00">18:00</option><option value="18:15">18:15</option>
                                <option value="18:30">18:30</option><option value="18:45">18:45</option>
                                <option value="19:00">19:00</option><option value="19:15">19:15</option>
                                <option value="19:30">19:30</option><option value="19:45">19:45</option>
                                <option value="20:00">20:00</option><option value="20:15">20:15</option>
                                <option value="20:30">20:30</option><option value="20:45">20:45</option>
                            </select>
                            <select name="number" id="number" class="storereserve__form-input">
                                <option value="1">1人</option><option value="2">2人</option>
                                <option value="3">3人</option><option value="4">4人</option>
                                <option value="5">5人</option><option value="6">6人</option>
                            </select>
                        </div>
                        <div class="storereserve__conf">
                            <ul class="storereserve__conf-list">
                                <li>
                                    <span class="storereserve__conf-item-name">Shop</span>
                                    <span class="storereserve__conf-item">{{ $store->name }}</span>
                                </li>
                                <li>
                                    <span class="storereserve__conf-item-name">Date</span>
                                    <span class="storereserve__conf-item" id="display_reserve_date">-</span>
                                </li>
                                <li>
                                    <span class="storereserve__conf-item-name">Time</span>
                                    <span class="storereserve__conf-item" id="display_reserve_time">18:00</span>
                                </li>
                                <li>
                                    <span class="storereserve__conf-item-name">Number</span>
                                    <span class="storereserve__conf-item" id="display_number">1人</span>
                                </li>
                            </ul>
                        </div>
                        <div class="storereserve__form-submit">
                            <input type="submit" value="予約する" class="storereserve__form-submit-btn" />
                        </div>
                    </form>
                </div><!-- storereserve__form-wrap -->
            </div><!-- storereserve -->
            @if( isset($user) )
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
                                <li class="storereserved__conf-list">
                                    <span class="storereserve__conf-item-name">Date</span>
                                    <span class="storereserve__conf-item">{{ $reserve->reserve_date }}</span>
                                </li>
                                <li class="storereserved__conf-list">
                                    <span class="storereserve__conf-item-name">Time</span>
                                    <span class="storereserve__conf-item">{{ substr($reserve->reserve_time, 0, 5) }}</span>
                                </li>
                                <li class="storereserved__conf-list">
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
                                    <a href="/reserve/change/{{ $reserve->id }}" class="storereserved__edit-btn">
                                        変更
                                    </a>
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
            @else
                未ログイン
            @endif
        </div>
    </div>
@endsection