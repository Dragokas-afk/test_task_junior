<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\SendNotificationsForUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EquipmentController extends Controller
{

    //Страница с созданием нового оборудования
    public function index(Request $request)
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $request->url()
        );
        return view('newEquipment');

    }
    //Страница с новым оборудованием
    public function indexList(Request $request)
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $request->url()
        );
        return view('equipmentList', [
            'newEquipmentList' => Equipment::where('status', 'Новое')->get(),
            'stocks' => \App\Models\Stock::all()]);

    }
    //Логика перемещения оборудования
    public function replaceEquipment(Request $request)
    {

        Equipment::replaceEquipment($request);
        SendNotificationsForUsers::sendNotifyProvider($request);

        return back()->with(['success' => 'Успешно перемещен']);
    }

    //Логика создания оборудования
    public function createEquipment(Request $request)
    {

        Equipment::createEquipment($request);
        SendNotificationsForUsers::sendNotifyManager($request);

        return back()->with(['success' => 'Успешно']);
    }


}
