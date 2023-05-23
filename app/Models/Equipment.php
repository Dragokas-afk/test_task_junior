<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class Equipment extends Model
{
    use HasFactory;

    public $timestamps = false;



    protected $fillable = [
        'full_name',
        'price',
        'series_number',
        'created_at',
        'inventory_number',
        'provider_id',
        'manager_id'
    ];

    //Запрос в базу данных на обновление, в связи с перемещением оборудования
    public static function replaceEquipment($request)
    {

        Equipment::where('id', $request->value_id)->update(['stock_id' => $request->stock_id, 'move_date' => date('Y-m-d'), 'status' => 'Перемещен', 'manager_id' => Auth::id()]);

        Log::channel('daily')->info(
            'Оборудование было перемещено с id: '
            . $request->value_id
            . ' в следующий склад id: '
            . $request->stock_id
            . ' Дата перемещения: '
            . date('Y-m-d')
            . ' Изменен статус на: Перемещен '
            . ' Переместил менеджер id: ' . Auth::id()
        );

    }
    //Запрос в базу данных на добавление нового оборудования
    public static function createEquipment($request)
    {

        $request->validate([
            'full_name' => 'required|string|max:100',
            'price' => 'required|decimal:0,2',
            'series_number' => 'required|string|max:13|unique:equipment',
            'inventory_number' => 'required|string|max:8|unique:equipment'
        ]);

        Equipment::create([
            'full_name' => $request->full_name,
            'price' => $request->price,
            'series_number' => $request->series_number,
            'inventory_number' => $request->inventory_number,
            'created_at' => date('Y-m-d'),
            'provider_id' => Auth::id()
        ]);
        Log::channel('daily')->info(
            'Создано новое оборудование <<' . $request->full_name . '>> ' . 'Создал поставщик: ' . Auth::id()
        );

        return true;

    }
    //Запрос в базу данных на получение полей независимо друг от друга
    public static function filterManager($created_at, $price_from, $price_to, $move_date)
    {

        $result = Equipment::where('status', 'Перемещен')
            ->when($created_at, function ($query) use ($created_at) {
                $query->where('created_at', $created_at);
            })
            ->when($move_date, function ($query) use ($move_date) {
                $query->where(function ($query) use ($move_date) {
                    $query->where('status', 'Перемещен')->where('move_date', $move_date);
                });
            })->when(function ($query) use ($price_from, $price_to) {
                if (($price_from && !$price_to) || ($price_from == 0 && !$price_to)) {
                    if ($price_from == 0 && !$price_from) {
                        $price_from = Equipment::min('price');
                        return $query->where('price', '>=', $price_from);
                    } else {
                        return $query->where('price', '>=', $price_from);
                    }
                } elseif (($price_to && !$price_from) || ($price_to == 0 && !$price_from)) {
                    return $query->where('price', '<=', $price_to);
                } elseif ($price_to && $price_from) {
                    return $query->whereBetween('price', [$price_from, $price_to]);
                }
                return true;
            });
        Log::channel('daily')->info(
            'Применил фильтры менеджер id: ' . Auth::id()
        );
        return $result;

    }
    //Запрос в базу данных для получение всего перемещенного оборудования
    public static function searchManager($search)
    {
       $result = Equipment::where('status', 'Перемещен')
            ->where(function ($query) use ($search) {
                $query->where('full_name', $search)
                    ->orWhere('series_number', $search)
                    ->orWhere('inventory_number', $search);
            })->get();
        Log::channel('daily')->info(
            'Применил поиск менеджер id: ' . Auth::id()
        );
       return $result;
    }



}
