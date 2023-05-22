<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FilterController extends Controller
{

// TODO: Validation Filters
// TODO: Move logic to models
// TODO: Normal Redirects
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
            'equipmentList' => Equipment::all(),
            'equipmentSearch' => Equipment::where('full_name', $search)->orWhere('series_number', $search)->orWhere('inventory_number', $search)->get(),
            'equipmentFilter' => Equipment::where('created_at', $created_at)->orWhere('status', $status)->orWhereBetween('price', [$price_from, $price_to])->get()]);
    }

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
            'stocks' => Equipment::join('stocks', 'equipment.stock_id', '=', 'stocks.id')->select('stocks.*')->get(),
            'equipmentSearch' => Equipment::searchManager($search),
            'equipmentFilter' => Equipment::filterManager($created_at, $price_from, $price_to, $move_date)->get()
        ]);
    }


}
