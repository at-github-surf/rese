@extends('layouts.header')

@section('title')
<title>Rese管理者ページ | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/siteadmin/index.css') }}">
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
                @if($user->auth_id == 1)
                <li class="hamburger__item"><a href="/siteadmin">ManageStoremanager</a></li>
                @endif
            </ul>
        </nav>
        <label for="menu-btn-check" class="hamburger__button">
            <span></span>
        </labe>
    </div>
@endsection

@section('header_func_multibtn')
    <div class="multibtn">
        <a href="/siteadmin/addmanager" class="multibtn__label">
        店舗代表者追加
        </a>
    </div>
@endsection

@section('content')
    <div class="content__wrapper">
        <div class="sendmail__wrapper">
            <div class="sendmail__btn">
                <a class="sendmail__btn--lable" href="/siteadmin/sendmail">一般ユーザー向け一斉メール配信</a>
            </div>
        </div>
        <div class="storemasterlist__wrapper"> 
            <ul class="storemasterlist">
                <li class="storemasterlist__title">
                    <div class="storemasterlist__title-item">
                        <div class="storemasterlist__item-username">
                            店舗代表者名
                        </div>
                        <div class="storemasterlist__item-email">
                            メールアドレス
                        </div>
                    </div>
                </li><!-- storemasterlist__title -->
                @foreach($storeManagers as $storeManager)
                <li class="storemasterlist__item-row">
                    <div class="storemasterlist__item-username">
                        {{ $storeManager->name }}
                    </div>
                    <div class="storemasterlist__item-email">
                        <a href="mailto:{{ $storeManager->email }}">{{ $storeManager->email }}</a>
                    </div>
                </li><!-- storemasterlist__item -->
                @endforeach
                
            </ul><!-- storemasterlist -->
        </div><!-- storemasterlist__wrapper -->
    </div><!-- content__wrapper -->
@endsection