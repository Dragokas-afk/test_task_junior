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
                <div class="search_wrapper">
                    <h1>Поиск</h1>
                    <div class="">
                        <input class="filter_form_input" type="text" name="search">
                        <input class="btn" type="submit" name="submit" value="Отправить">
                    </div>
                </div>
            </form>
        </div>

        <h1>Все записи</h1>

        @if(!isset($_GET['submit']))
            <div class="equipmentList">
                @foreach($equipmentList as $equipment)

                    <div class="equipmentListElements">
                        <div>Полное наименование: <b>{{$equipment->full_name}}</b></div>
                        <div>Цена: <b>{{$equipment->price}}</b></div>
                        <div>Серийный номер: <b>{{$equipment->series_number}}</b></div>
                        <div>Иневентарный номер: <b>{{$equipment->inventory_number}}</b></div>
                        <div>Дата создания: <b>{{$equipment->created_at}}</b></div>
                        <div>Статус: <b>{{$equipment->status}}</b></div>
                    </div>

                @endforeach
            </div>
        @endif

        @if(isset($_GET['submit']) && count($equipmentFilter) < 1 && count($equipmentSearch) < 1)
            <h1>Результаты не найдены</h1>
        @endif

        @if(!empty($equipmentFilter))
            <div class="equipmentList">
                @foreach($equipmentFilter as $equipment)

                    <div class="equipmentListElements">
                        <div>Полное наименование: <b>{{$equipment->full_name}}</b></div>
                        <div>Цена: <b>{{$equipment->price}}</b></div>
                        <div>Серийный номер: <b>{{$equipment->series_number}}</b></div>
                        <div>Иневентарный номер: <b>{{$equipment->inventory_number}}</b></div>
                        <div>Дата создания: <b>{{$equipment->created_at}}</b></div>
                        <div>Статус: <b>{{$equipment->status}}</b></div>
                    </div>

                @endforeach
            </div>
        @endif
        @if(!empty($equipmentSearch))
            <div class="equipmentList">
                @foreach($equipmentSearch as $equipment)
                    <div class="equipmentListElements">
                        <div>Полное наименование: <b>{{$equipment->full_name}}</b></div>
                        <div>Цена: <b>{{$equipment->price}}</b></div>
                        <div>Серийный номер: <b>{{$equipment->series_number}}</b></div>
                        <div>Иневентарный номер: <b>{{$equipment->inventory_number}}</b></div>
                        <div>Дата создания: <b>{{$equipment->created_at}}</b></div>
                        <div>Статус: <b>{{$equipment->status}}</b></div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    @if(Auth::user()->isManager())

        <div class="form_wrapper">
            <form method="get">
                @csrf
                <h1 class="text_filter">Фильтры</h1>
                <div class="filter_form">
                    <label for="created_at">Дата регистрации</label>
                    <input class="filter_form_input" type="date" name="created_at">
                    <input class="filter_form_input" type="date" name="move_date">
                    <label for="price_from">Цена от</label>
                    <input class="filter_form_input" type="text" name="price_from" placeholder="От">
                    <label for="price_to">Цена до</label>
                    <input class="filter_form_input" type="text" name="price_to" placeholder="До">
                </div>
                <div class="radio_filter">
                    <input class="btn" type="submit" name="submitFilter" value="Отправить">
                </div>
            </form>

            <form method="get">
                <input class="btn" type="submit" name="reset" value="Сбросить">
            </form>
            <form method="get">
                @csrf
                <div class="search_wrapper">
                    <h1>Поиск</h1>
                    <div class="">
                        <input class="filter_form_input" type="text" name="search">
                        <input class="btn" type="submit" name="submitSearch" value="Отправить">
                    </div>
                </div>
            </form>
        </div>


        <h1>Все записи</h1>


        @if(!isset($_GET['submitFilter']) && !isset($_GET['submitSearch']))
            <div class="equipmentList">
                @foreach($equipmentMove as $equipment)
                    <div class="equipmentListElements">
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                                @break
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
            <h1>Отфильтрованные: </h1>
            <div class="equipmentList">
                @foreach($equipmentFilter as $equipment)

                    <div class="equipmentListElements">
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                                @break
                            @endif
                        @endforeach
                    </div>

                @endforeach
            </div>
        @endif

        @if(isset($_GET['submitSearch']) && count($equipmentSearch) > 0)
            <h1>Найденные: </h1>
            <div class="equipmentList">
                @foreach($equipmentSearch as $equipment)
                    <div class="equipmentListElements">
                        <p>Полное наименование: {{$equipment->full_name}}</p>
                        <p>Цена: {{$equipment->price}}</p>
                        <p>Серийный номер: {{$equipment->series_number}}</p>
                        <p>Инвентарный номер: {{$equipment->inventory_number}}</p>
                        <p>Дата регистрации: {{$equipment->created_at}}</p>
                        <p>Дата перемещения: {{$equipment->move_date}}</p>
                        @foreach($stocks as $stock)
                            @if($equipment->stock_id == $stock->id)
                                <div>Склад: {{ $stock->name }}</div>
                                @break
                            @endif
                        @endforeach
                    </div>
                @endforeach
                <div>
        @endif
    @endif

@endsection
