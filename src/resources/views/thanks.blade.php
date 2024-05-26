@extends('layouts.header')

@section('title')
<title>登録完了 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('header_hamburger')
    <!-- ハンバーガーメニューボタン -->
    <div class="hamburger">
        <input type="checkbox" id="menu-btn-check">
        <nav class="hamburger__menu">
            <ul class="hamburger__list">
                <li class="hamburger__item"><a href="/">Home</a></li>
                <li class="hamburger__item"><a href="/register">Registration</a></li>
                <li class="hamburger__item"><a href="/login">Login</a></li>
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
                <span class="dialog__message">会員登録ありがとうございます</span>
                <div class="dialog__login"><a href="/login" class="dialog__login-label">ログインする</a></div>

            </div>
        </div>
    </div>
@endsection