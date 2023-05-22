@extends('layout.main')

@section('title', 'Кабинет менеджера')

@section('content')

    @if(Auth::user()->isProvider())
        <div class="form_wrapper">
            <form method="get">
                @csrf
                <h1 class="text_filter">Фильтры</h1>
                <div class="filter_form">
                    <label for="created_at">Дата регистрации</label>
                    <input class="filter_form_input" type="date" name="created_at">
                    <label for="price_from">Цена от</label>
                    <input class="filter_form_input" type="text" name="price_from" placeholder="От">
                    <label for="price_to">Цена до</label>
                    <input class="filter_form_input" type="text" name="price_to" placeholder="До">
                </div>
                <div class="radio_filter">
                    <input class="btn" type="submit" name="submit" value="Отправить">
                    <div>
                        <input class="radio_elem" type="radio" name="status" value="Новое">
                        <label for="status">Новое</label>
                    </div>
                    <div>
                        <input class="radio_elem" type="radio" name="status" value="Перемещен">
                        <label for="status">Перемещен</label>
                    </div>
                </div>
            </form>

            <form method="get">
                <input class="btn" type="submit" name="reset" value="Сбросить">
            </form>
            <form method="get">
                @csrf
                <h1>Поиск</h1>
                <div class="">
                    <input type="text" name="search">
                    <input type="submit" name="submit" value="Отправить">
                </div>

            </form>
        </div>

        <h1>Все записи</h1>

        @if(!isset($_GET['submit']))
            @foreach($equipmentList as $equipment)

                <div>{{$equipment->full_name}}</div>
                <div>{{$equipment->price}}</div>
                <div>{{$equipment->series_number}}</div>
                <div>{{$equipment->inventory_number}}</div>
                <div>{{$equipment->created_at}}</div>
                <div>{{$equipment->status}}</div>
                </br>
            @endforeach
        @endif

        @if(isset($_GET['submit']) && count($equipmentFilter) < 1 && count($equipmentSearch) < 1)
            <h1>Результаты не найдены</h1>
        @endif

        @if(!empty($equipmentFilter))
            @foreach($equipmentFilter as $equipment)

                <div>{{$equipment->full_name}}</div>
                <div>{{$equipment->price}}</div>
                <div>{{$equipment->series_number}}</div>
                <div>{{$equipment->inventory_number}}</div>
                <div>{{$equipment->created_at}}</div>
                <div>{{$equipment->status}}</div>

            @endforeach
        @endif
        @if(!empty($equipmentSearch))
            @foreach($equipmentSearch as $equipment)

                <div>{{$equipment->full_name}}</div>
                <div>{{$equipment->price}}</div>
                <div>{{$equipment->series_number}}</div>
                <div>{{$equipment->inventory_number}}</div>
                <div>{{$equipment->created_at}}</div>
                <div>{{$equipment->status}}</div>

            @endforeach
        @endif
    @endif

    @if(Auth::user()->isManager())
        <h2>Отфилтрованные:</h2>
        <form method="get">
            @csrf
            <input type="date" name="created_at">Дата регистрации
            <input type="date" name="move_date">Дата Перемещения
            <div>
                <input type="text" name="price_from" placeholder="От">
                <input type="text" name="price_to" placeholder="До">
            </div>
            <input type="submit" name="submitFilter" value="Отправить">
        </form>

        <form method="get">
            <input type="submit" name="reset" value="Сбросить">
        </form>
        <h2>Найденные</h2>
        <form method="get">
            @csrf
            <input type="text" name="search">
            <input type="submit" name="submitSearch" value="Отправить">
        </form>




        <h1>Все записи</h1>


        @if(!isset($_GET['submitFilter']) && !isset($_GET['submitSearch']))
            <div style="">
                @foreach($equipmentMove as $equipment)
                    <div>
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

        @if(isset($_GET['submitFilter']) && isset($_GET['submitSearch']) && count($equipmentFilter) < 0 && count($equipmentSearch) < 0)
            <h1>Результаты не найдены</h1>
        @endif

        @if(isset($_GET['submitFilter']) && count($equipmentFilter) > 0)
            <h1>Фильтры</h1>
            <div style="display: flex; justify-content: space-between; ">
                @foreach($equipmentFilter as $equipment)

                    <div>
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                            @endif
                        @endforeach
                    </div>

                @endforeach
            </div>
        @endif

        @if(isset($_GET['submitSearch']) && count($equipmentSearch) > 0)
            <h1>Поиск</h1>
            <div style="display: flex; justify-content: space-between; ">
                @foreach($equipmentSearch as $equipment)
                    <div>
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
                <div>
        @endif
    @endif

@endsection
