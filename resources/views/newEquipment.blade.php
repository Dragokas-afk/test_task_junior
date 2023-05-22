@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')

<form method="post">
    @csrf
    <input type="text" name="full_name">
    @error('full_name') {{ $message }} @enderror
    <input type="text" name="price">
    @error('price') {{ $message }} @enderror
    <input type="text" name="series_number">
    @error('series_number') {{ $message }} @enderror
    <input type="text" name="inventory_number">
    @error('inventory_number') {{ $message }} @enderror
    <input type="submit" name="addEquipment" value="Отправить">
    @if(session()->has('success'))
        {{ session()->get('success') }}
    @endif
</form>

@endsection
