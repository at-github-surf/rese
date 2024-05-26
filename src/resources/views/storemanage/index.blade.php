@extends('layouts.header')

@section('title')
<title>店舗代表者ページ | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/storemanage/index.css') }}">
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
@if( isset($myStore) )
    <div class="multibtn">
        <a href="/storemanage/reserve/{{ $myStore->id }}" class="multibtn__label">
        予約を確認する
        </a>
    </div>
@endif
@endsection

@section('content')
    <div class="content__wrapper">
        <div class="storedetail">
            @if( isset($myStore) )
            <div class="storedetail__title-wrapper">
                <div class="storedetail__title-ico">
                    <span class="storedetail__title-ico-back">-</span>
                </div>
                <h3 class="storedetail__name">{{ $myStore->name }}</h3>
            </div>
            <figure class="storedetail__img-wrapper">
                <img class="storedetail__img" src="{{ config('rese.img_path') }}{{ $myStore->image_url }}" alt="{{ $myStore->name }}">
            </figure>
            <div class="storedetail__tag">
                #{{ $myStore->area }} #{{ $myStore->genre }}
            </div>
            <div class="storedetail__text">
                {{ $myStore->detail }}
            </div>
            @else
            <div class="storedetail__title-wrapper">
                <div class="storedetail__title-ico">
                    <span class="storedetail__title-ico-back">-</span>
                </div>
                <h3 class="storedetail__name">未設定</h3>
            </div>
            <figure class="storedetail__img-wrapper">
                @if( isset($store) )
                <img class="storedetail__img" src="{{ config('rese.img_path') }}{{ $store->image_url }}" alt="{{ $store->name }}">
                @else
                <div class="storedetail__noimg"><span class="storedetail__noimg-text">no image</span></div>
                @endif
            </figure>
            <div class="storedetail__tag">
                #未設定 #未設定
            </div>
            <div class="storedetail__text">
                未設定
            </div>
            @endif
            <div class="storedetail__evaluation">
                <div class="storedetail__stars">
                    <span style="background: linear-gradient(90deg, #e6b422 0%, 
                                                             #e6b422 {{ $star_score / 5 * 100}}%, 
                                                             #ddd {{ $star_score / 5 *100 }}%, 
                                                             #ddd);
                                 -webkit-background-clip: text;
                                 -webkit-text-fill-color: transparent;">★★★★★
                    </span>
                </div>
                @if( isset($evaluations) )
                <div class="storedetail__stars-num">評価数 {{ $evaluations->count() }}</div>
                @else
                <div class="storedetail__stars-num">評価数 0</div>
                @endif
            </div>
            <div class="store-prsnl-evaluation-wrap">
                @if( isset($evaluations) )
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
                @endif
            </div>
        </div><!-- storedetail -->

        @if( isset($myStore) )
        <div class="storeedit__wrap">
            <div class="storeedit">
                <div class="storeedit__title">店舗情報編集</div>
                <div class="storeedit__form-wrap">
                    <form method="post" action="/storemanage/{{ $myStore->id }}" enctype="multipart/form-data">
                        @csrf
                        <ul class="storeedit__form-list">
                            <li>
                                <div class="storeedit__form-list-item">
                                    <div class="storeedit__form-list-item--label">
                                        <label for="name">
                                            <span>
                                            店名
                                            </span>
                                        </labe>
                                    </div>
                                    <div class="storeedit__form-list-item--value">
                                        @if( $errors->has('name') == '' )
                                        <input name="name" id="name" type="text" value="{{ $myStore->name }}">
                                        @else
                                        <input name="name" id="name" type="text" value="{{ old('name') }}">
                                        @endif
                                        @error('name')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <div class="storeedit__form-list-item--label">
                                        <label for="file">
                                            <span>画像ファイル</span>
                                        </labe>
                                    </div>
                                    <div>
                                    <input class="storeedit__form-list-item--file" type="file" name="file" id="file" accept = "image/png" />
                                    @error('file')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                    @enderror
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="area">エリア</label>
                                    <select name="area" id="area">
                                        @foreach($areas as $area)
                                        @if($area->area == $myStore->area)
                                        <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                        @else
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="genre">ジャンル</label>
                                    <select name="genre" id="genre">
                                        @foreach($genres as $genre)
                                        @if($genre->genre == $myStore->genre)
                                        <option value="{{ $genre->id }}" selected>{{ $genre->genre }}</option>
                                        @else
                                        <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="detail">詳細</label>
                                    <div class="storeedit__form-list-item--textarea-wrap">
                                    @if( $errors->has('detail') == '' )
                                    <textarea class="storeedit__form-list-item--textarea" name="detail" id="detail">{{ $myStore->detail }}</textarea>
                                    @else
                                    <textarea class="storeedit__form-list-item--textarea" name="detail" id="detail">{{ old('detail') }}</textarea>
                                    @endif
                                    @error('detail')
                                    <br><strong class="form__error">{{ $message }}</strong>
                                    @enderror
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="storeedit__form-submit">
                            <input type="submit" value="変更する" class="storeedit__form-submit-btn" />
                        </div>
                    </form>
                </div><!-- storeedit__form-wrap -->
            </div><!-- storeedit -->
        </div>
        @else
        <div class="storeedit__wrap">
            <div class="storeedit">
                <div class="storeedit__title">店舗情報登録</div>
                <div class="storeedit__form-wrap">
                    <form method="post" action="/storemanage" enctype="multipart/form-data">
                        @csrf
                        <ul class="storeedit__form-list">
                            <li>
                                <div class="storeedit__form-list-item">
                                    <div class="storeedit__form-list-item--label">
                                        <label for="name">
                                            <span>
                                            店名
                                            </span>
                                        </labe>
                                    </div>
                                    <div class="storeedit__form-list-item--value">
                                        <input name="name" id="name" type="text" value="{{ old('name') }}">
                                        @error('name')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <div class="storeedit__form-list-item--label">
                                        <label for="file">
                                            <span>画像ファイル</span>
                                        </labe>
                                    </div>
                                    <div>
                                    <input class="storeedit__form-list-item--file" type="file" name="file" id="file" accept = "image/png" />
                                    @error('file')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                    @enderror
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="area">エリア</label>
                                    <div class="storeedit__form-list-item--value">
                                        <select name="area" id="area">
                                            <option value="">選択してください。</option>
                                            @foreach($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                                            @endforeach
                                        </select>
                                        @error('area')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="genre">ジャンル</label>
                                    <div class="storeedit__form-list-item--value">
                                        <select name="genre" id="genre">
                                            <option value="">選択してください。</option>
                                            @foreach($genres as $genre)
                                            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                                            @endforeach
                                        </select>
                                        @error('genre')
                                        <br><strong class="form__error">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="storeedit__form-list-item">
                                    <label class="storeedit__form-list-item--label" for="detail">詳細</label>
                                    <div class="storeedit__form-list-item--textarea-wrap">
                                    <textarea class="storeedit__form-list-item--textarea" name="detail" id="detail">{{ old('detail') }}</textarea>
                                    @error('detail')
                                    <br><strong class="form__error">{{ $message }}</strong>
                                    @enderror
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="storeedit__form-submit">
                            <input type="submit" value="登録する" class="storeedit__form-submit-btn" />
                        </div>
                    </form>
                </div><!-- storeedit__form-wrap -->
            </div><!-- storeedit -->
        </div>
        @endif
    </div>
@endsection