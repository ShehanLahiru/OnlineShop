<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('backend.welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $start_date = Carbon::now()->subDays(30);
        $end_date = Carbon::now();
        $period = CarbonPeriod::create($start_date, $end_date);
        $users = User::where('user_type',"user")->whereBetween('created_at', [$start_date->toDateTimeString(), $end_date->toDateTimeString()])->get();
        $date_array = [];
        $count_array = [];

        foreach ($period as $date) {
            $formatted_date = $date->shortEnglishMonth . " " . $date->day;
            $iso_date = $date->toDateString();
            $date_array[] = $formatted_date;
            $count_array[] = $users->filter(function ($item) use ($iso_date) {
                return false !== stristr($item->created_at, $iso_date);
            })->count();
        }
        return view('backend.home', [
            "date_array" => $date_array,
            "count_array" => $count_array,
        ]);
    }
}
