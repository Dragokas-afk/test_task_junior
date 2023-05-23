@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')

<form method="post">
    <div class="form_wrapper" style="gap: 10px;">

    <h1 class="text_filter">Добавить новое оборудование</h1>
    @csrf
    <input  class="filter_form_input"type="text" name="full_name" placeholder="Полное наименование">
    @error('full_name') {{ $message }} @enderror
    <input class="filter_form_input" type="text" name="price" placeholder="Цена">
    @error('price') {{ $message }} @enderror
    <input  class="filter_form_input" type="text" name="series_number" placeholder="Серийный номер">
    @error('series_number') {{ $message }} @enderror
    <input class="filter_form_input" type="text" name="inventory_number" placeholder="Инвентарный номер">
    @error('inventory_number') {{ $message }} @enderror
    <input type="submit" name="addEquipment" class="btn" value="Отправить">
    @if(session()->has('success'))
        {{ session()->get('success') }}
    @endif
        </div>
</form>

@endsection
