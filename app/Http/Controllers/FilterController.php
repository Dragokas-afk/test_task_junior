<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FilterController extends Controller
{
    //Функция получения отфитрованных, найденных и всех записей для Поставщика
    public function reportProvider(Request $request)
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        );

        $created_at = $request->query('created_at');
        $price_from = $request->query('price_from');
        $price_to = $request->query('price_to');
        $status = $request->query('status');
        $search = $request->query('search');

        return view('report', [
            'equipmentList' => Equipment::all(),//Получение всех записей Equipment
            'equipmentSearch' => Equipment::where('full_name', $search)->orWhere('series_number', $search)->orWhere('inventory_number', $search)->get(),//Получения найденных записей с помощью поиска
            'equipmentFilter' => Equipment::where('created_at', $created_at)->orWhere('status', $status)->orWhereBetween('price', [$price_from, $price_to])->get()]);//Получение отфилтрованных записей с заданными фильтрами
    }
    //Функция получения отфитрованных, найденных и всех записей для Управляющего
    public function reportManager(Request $request)
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        );

        $created_at = $request->query('created_at');
        $price_from = $request->query('price_from');
        $price_to = $request->query('price_to');
        $move_date = $request->query('move_date');
        $search = $request->query('search');



        return view('report', [
            'equipmentMove' => Equipment::where('status', 'Перемещен')->get(), //Передавать только Перемещенное оборудование
            'stocks' => Equipment::join('stocks', 'equipment.stock_id', '=', 'stocks.id')->select('stocks.*')->get(),//Присоединение таблицы stocks к equipment для получения id складов
            'equipmentSearch' => Equipment::searchManager($search),//вызов статической функции поиска для менеджера
            'equipmentFilter' => Equipment::filterManager($created_at, $price_from, $price_to, $move_date)->get()//вызов статической функции фильтра для менеджера
        ]);
    }


}
