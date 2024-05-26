@extends('layouts.header')

@section('title')
<title>ログイン | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                <div class="dialog__title">
                    login
                </div>
                <form method="post" action="/login" class="form">
                    @csrf
                    <ul class="form__items">
                        <li class="form__item">
                            <input type="text" class="form__input" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                            @error('email')
                            <strong class="form__error">{{ $message }}</strong>
                            @enderror
                        </li>
                        <li class="form__item">
                            <input type="password" class="form__input" name="password" id="password" value="{{ old('email') }}" placeholder="Password" />
                            @error('password')
                            <strong class="form__error">{{ $message }}</strong>
                            @enderror
                        </li>
                    </ul>
                    <div class="form__submit">
                        <button class="form__btn-submit" type="submit">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection