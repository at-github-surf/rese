@extends('layouts.header')

@section('title')
<title>会員登録 | rese</title>
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
                registration
            </div>
            <form method="post" action="/register" class="form">
                @csrf
                <ul class="form__items">
                    <li class="form__item">
                        <input type="text" class="form__input" name="name" id="name" value="{{ old('name') }}" placeholder="Username" />
                        @error('name')
                        <strong class="form__error">{{ $message }}</strong>
                        @enderror
                    </li>
                    <li class="form__item">
                        <input type="text" class="form__input" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                        @error('email')
                        <strong class="form__error">{{ $message }}</strong>
                        @enderror
                    </li>
                    <li class="form__item">
                        <input type="password" class="form__input" name="password" id="password" placeholder="Password" />
                        @error('password')
                        <strong class="form__error">{{ $message }}</strong>
                        @enderror
                    </li>
                    <li class="form__item">
                        <input type="password" class="form__input" name="password_confirmation" id="password_confirmation" value="{{ old('email') }}" placeholder="Confirmation password" />
                    </li>
                    <li class="form__item-hidden">
                        <input type="hidden" class="form__input" name="auth_id" id="auth_id" value="0" />
                    </li>
                </ul>
                <div class="form__submit">
                    <button class="form__btn-submit" type="submit">登録</button>
                </div>
            </form>
            <span>登録済みの方は<a href="/login">ログイン</a>ページへ</span>
        </div>
    </div>
</div>
@endsection