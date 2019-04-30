<?php

namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Record;
use Atsargų_likučiai\RecordTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

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
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('db', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function indeksas()
    {
        $records = Record::all();
        $kopijos = RecordTest::all();
        return view('tabletest', compact('records', 'kopijos'));

    }
    public function roles(){
        $users = DB::table('users')->get();

        return view('home', ['users' => $users]);
    }

    public function skyriuRodymas (){
    $skyriai = DB::table('skyriai')->select('name')->from('skyriai')
        ->join('vartotojas_skyrius', function ($join){
            $join->on('skyriai.id', '=', 'vartotojas_skyrius.SkyriausID')
                ->where('vartotojas_skyrius.vartotojoID', '=', Auth::id());
        } )
        ->get();


        return view('home', ['skyriai' => $skyriai]);
    }

    public function admin()
    { return view('admin'); }
}



/*
SELECT
`skyriai`.*
FROM
`skyriai`
JOIN `vartotojas_skyrius` ON `skyriai`.`ID` = `vartotojas_skyrius`.`SkyriausID`
WHERE
`vartotojas_skyrius`.`vartotojoID` = 6
*/