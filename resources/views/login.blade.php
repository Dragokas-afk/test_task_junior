@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')
 <div class=""></div>
<form method="post">
    @csrf
    <input type="text" name="login">
    @error('login') {{ $message }} @enderror
    <input type="password" name="password">
    @error('password') {{ $message }} @enderror
    <input type="submit">
</form>

@endsection
