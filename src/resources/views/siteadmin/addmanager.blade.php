@extends('layouts.header')

@section('title')
<title>店舗代表者登録 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/siteadmin/addmanager.css') }}">
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

@endsection

@section('content')
    <div class="dialog__wrapper">
        <div class="dialog__outer">
            <div class="dialog__inner">
                <div class="dialog__title">
                    store manager registration
                </div>
                <form method="post" action="/siteadmin/addmanager" class="form">
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
                            <input type="password" class="form__input" name="password" id="password" value="{{ old('email') }}" placeholder="Password" />
                            @error('password')
                            <strong class="form__error">{{ $message }}</strong>
                            @enderror
                        </li>
                        <li class="form__item">
                            <input type="password" class="form__input" name="password_confirmation" id="password_confirmation" value="{{ old('email') }}" placeholder="Confirmation password" />
                        </li>
                        <li class="form__item">
                            <input type="hidden" class="form__input" name="auth_id" id="auth_id" value="2" readonly />
                        </li>
                    </ul>
                    <div class="form__submit">
                        <button class="form__btn-submit" type="submit">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection