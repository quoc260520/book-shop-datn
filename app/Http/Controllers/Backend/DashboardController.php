<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $subDay = $now->copy()->subDays(30);
        $orderStatistical30day = Order::whereDate('created_at', '<=', $now->format('Y-m-d'))
            ->whereDate('created_at', '>=', $subDay->format('Y-m-d'))
            ->get();
        $arrayOrderStatus = [
            'pending' => $orderStatistical30day->where('status', Order::STATUS_PENDING)->count(),
            'ship' => $orderStatistical30day->where('status', Order::STATUS_SHIP)->count(),
            'success' => $orderStatistical30day->where('status', Order::STATUS_SUCCESS)->count(),
            'error' => $orderStatistical30day->where('status', Order::STATUS_ERROR)->count(),
        ];
        $orderByDay = [];
        for ($i = 30; $i >= 0; $i--) {
            $orderByDay[
                Carbon::now()
                    ->subDays($i)
                    ->format('Y-m-d')
            ] = $orderStatistical30day
                ->where(
                    'created_at',
                    '>=',
                    Carbon::now()
                        ->subDays($i)
                        ->startOfDay(),
                )
                ->where(
                    'created_at',
                    '<=',
                    Carbon::now()
                        ->subDays($i)
                        ->endOfDay(),
                )
                ->count();
        }

        $countOrderToday = $orderStatistical30day
            ->where('created_at', '>=', Carbon::now()->startOfDay())
            ->where('created_at', '<=', Carbon::now()->endOfDay())
            ->whereIn('status', [Order::STATUS_PENDING, Order::STATUS_SHIP])
            ->count();

        $countUser = User::where('active', User::ACTIVE)->count();

        $revenue = Order::whereYear('created_at', Carbon::now()->format('Y-m-d'));
        $revenueMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $revenueMonth[$m] = $revenue
                ->clone()
                ->whereMonth('created_at', intval($m))
                ->sum('total_money');
        }

        $revenueDifference = ($revenueMonth[Carbon::now()->month - 1] != 0) ? (($revenueMonth[Carbon::now()->month] - $revenueMonth[Carbon::now()->month - 1]) / $revenueMonth[Carbon::now()->month - 1]) * 100 : 0;

        return view('backend.statistical')
            ->withOrderStatistical30day(json_encode($orderStatistical30day))
            ->withArrayOrderStatus(json_encode($arrayOrderStatus))
            ->withOrderByDay(json_encode($orderByDay))
            ->withRevenueMonth(json_encode($revenueMonth))
            ->withCountOrderToday($countOrderToday)
            ->withCountUser($countUser)
            ->withRevenueDifference(round($revenueDifference, 2));
    }
}
