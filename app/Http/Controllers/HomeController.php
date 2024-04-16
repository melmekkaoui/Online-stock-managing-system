<?php

namespace App\Http\Controllers;

use App\Models\orderItems;
use App\Models\orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $TodayOrders = orders::where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->count();
        $TodayEarnings = orderItems::where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->sum('earnings');



        return view('index')
        ->with('orders',$TodayOrders)
        ->with('TodayEarnings',$TodayEarnings);
    }
}
