@extends('layouts.header')

@section('title')
<title>予約一覧ページ | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/storemanage/reserve.css') }}">
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
                <li class="hamburger__item"><a href="/storemanage">ManageStoreInfo</a></li>
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
        <div class="storemasterlist__wrapper"> 
            <ul class="storemasterlist">
                <li class="storemasterlist__title">
                    <div class="storemasterlist__title-item">
                        <div class="storemasterlist__item-username">
                            お名前
                        </div>
                        <div class="storemasterlist__item-email">
                            メールアドレス
                        </div>
                        <div class="storemasterlist__item-email">
                            予約日時
                        </div>
                        <div class="storemasterlist__item-email">
                            人数
                        </div>
                        <div class="storemasterlist__item-email">
                            来店確認URL
                        </div>
                    </div>
                </li><!-- storemasterlist__title -->
                @foreach($reserves as $reserve)
                <li class="storemasterlist__item-row">
                    <div class="storemasterlist__item-username">
                        {{ $reserve->name }}様
                    </div>
                    <div class="storemasterlist__item-email">
                        <a href="mailto:{{ $reserve->email }}">{{ $reserve->email }}</a>
                    </div>
                    <div class="storemasterlist__item-email">
                        {{ $reserve->reserve_date }}　{{ substr($reserve->reserve_time, 0, 5) }}
                    </div>
                    <div class="storemasterlist__item-email">
                        {{ $reserve->number }}名様
                    </div>
                    <div class="storemasterlist__item-email">
                        @if( is_null($reserve->visited) )
                        <a href="/storemanage/check/{{ $reserve->store_id }}/{{ $reserve->id }}">ご来店確認</a>
                        @else
                        ご来店確認済
                        @endif
                    </div>
                </li><!-- storemasterlist__item -->
                @endforeach
                
            </ul><!-- storemasterlist -->
        </div><!-- storemasterlist__wrapper -->
    </div><!-- content__wrapper -->
@endsection