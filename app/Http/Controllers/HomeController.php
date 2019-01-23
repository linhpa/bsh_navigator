<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;
use \Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('bsh_cases')
            ->select(DB::raw('           
                count(case when status = 1 or status is null or status = 0 then 1 else null end) as new,
                count(case when status = 2 then 1 else null end) as pending,
                count(case when status = 3 then 1 else null end) as done
            '));

        if (Auth()->user()->role != 'admin') {
            $data = $data->where('user_id', Auth::user()->id);
        }

        $data = $data->get();
            
        //$data = $data->whereRaw('date(updated_at) = date(now())')->get();

        return view('home', compact('data'));
    }
}
