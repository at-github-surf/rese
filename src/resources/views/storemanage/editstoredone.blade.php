@extends('layouts.header')

@section('title')
<title>予約完了 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/storemanage/editstoredone.css') }}">
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
                <span class="dialog__message">店舗情報の登録・編集を完了しました</span>
                <div class="dialog__return"><a href="/storemanage" class="dialog__return-label">戻る</a></div>
            </div>
        </div>
    </div>
@endsection