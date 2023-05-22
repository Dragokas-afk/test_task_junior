@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')

@auth
    @if(Auth::user()->isManager())
        @foreach($newEquipmentList as $value)
            <p>Полное наименование <b>{{$value->full_name}}</b></p>
            <p>Цена <b>{{$value->price}}</b></p>
            <p>Серийный номер <b>{{$value->series_number}}</b></p>
            <p>Инвентарный номер <b>{{$value->inventory_number}}</b></p>
            <p>Статус <b>{{$value->status}}</b></p>
            <p>Дата регистрации <b>{{$value->created_at}}</b></p>
            <form method="post">
                @csrf
                <select name="stock_id">
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}">{{$stock->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="value_id" value="{{ $value->id }}">
                <input type="submit" name="moveEquipment" value="Отправить">
            </form>
        @endforeach
        @if(session()->has('success'))
            {{ session()->get('success') }}
        @endif
    @endif
@endauth

@endsection
