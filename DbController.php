<?php

namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\RecordsExport;
use Atsargų_likučiai\RecordTest;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Atsargų_likučiai\Record;
class DbController extends Controller
{

    public function index()
    {

        $records = Record::all();
        $kopijos = RecordTest::all();
        return view('db', compact('records', 'kopijos'));

    }

    public function xs()
    {

        $records = Record::all();
        $pdf = PDF::loadView('db', compact('records'));
        return $pdf->download('itsolutionstuff.pdf');
    }



    public function roles(){
        $users = DB::table('users')->get();

        return view('db', ['users' => $users]);
    }

    public function skyriuRodymas (){
        $skyriai = DB::table('skyriai')->select('name')->from('skyriai')
            ->join('vartotojas_skyrius', function ($join){
                $join->on('skyriai.id', '=', 'vartotojas_skyrius.SkyriausID')
                    ->where('vartotojas_skyrius.vartotojoID', '=', Auth::id());
            } )
            ->get();


        return view('db', ['skyriai' => $skyriai]);
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