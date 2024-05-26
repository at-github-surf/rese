@extends('layouts.header')

@section('title')
<title>店舗代表者登録 | rese</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/siteadmin/sendmail.css') }}">
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
                    send message
                </div>
                <form method="post" action="/siteadmin/sendmail" class="form">
                    @csrf
                    <ul class="form__items">
                        <li class="form__item">
                            <input type="text" class="form__input" name="title" id="title" value="{{ old('title') }}" placeholder="Mail Title" />
                            @error('title')
                            <strong class="form__error">{{ $message }}</strong>
                            @enderror
                        </li>
                        <li class="form__item">
                            <textarea class="form__textarea" name="text" id="text" placeholder="Mail Text">{{ old('text') }}</textarea>
                            @error('text')
                            <strong class="form__error">{{ $message }}</strong>
                            @enderror
                        </li>
                    </ul>
                    <div class="form__submit">
                        <button class="form__btn-submit" type="submit">送信</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection