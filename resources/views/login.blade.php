@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')

<form method="post">
    <h1 class="text_filter">Авторизация</h1>
    @csrf
    <div  class="form_wrapper" style="gap: 10px;">
        <input class="filter_form_input" type="text" placeholder="Логин:" name="login">
        @error('login') {{ $message }} @enderror
        <input class="filter_form_input" type="password" placeholder="Пароль:" name="password">
        @error('password') {{ $message }} @enderror
        <input class="btn" type="submit">
    </div>
    @csrf

</form>

@endsection
