<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller{

    public function index(){



        $users=User::get();
        $rooms=Room::get();
        $devices=Device::get();
        $userCounts = User::select(DB::raw('COUNT(*) as total_users'), DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $roomCounts = Room::select(DB::raw('COUNT(*) as total_rooms'), DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'))
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $months = [];
        $userTotals = [];

        $roomMonths = [];
        $roomTotals = [];

    foreach ($userCounts as $userCount) {
        $months[] = date('F', mktime(0, 0, 0, $userCount->month));
        $userTotals[] = $userCount->total_users;
    }
    foreach ($roomCounts as $roomCount) {
        $roomMonths[] = date('F', mktime(0, 0, 0, $roomCount->month));
        $roomTotals[] = $roomCount->total_rooms;
    }

    $data = [
        'labels' => $months,
        'data' =>  $userTotals,
    ];
    $roomData = [
        'labels' => $roomMonths,
        'data' =>  $roomTotals,
    ];

        return view('admin.index',compact('data','roomData','users','rooms','devices'));
    }






}
