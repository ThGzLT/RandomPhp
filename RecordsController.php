<?php
namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Record;
use Atsargų_likučiai\RecordsExport;
use Atsargų_likučiai\RecordTest;
use Atsargų_likučiai\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class RecordsController extends Controller
{

    public function Copytodb(Request $request)
    {
        $request->validate([
            'produkto_kodas'=>'required',
            'produktas'=>'required',
            'matas'=> 'required',
            'kiekis' => 'required',
            'tag' => 'required'
        ]);
        $share = new RecordTest([
            'produkto_kodas' => $request->get('produkto_kodas'),
            'produktas'=> $request->get('produktas'),
            'matas'=> $request->get('matas'),
            'kiekis'=> $request->get('kiekis'),
            'tag'  => $request->get ('tag')
        ]);
        $share->save();
        return redirect('/db')->with('success', 'Stock has been added');
    }




    public function Copytodb2(Request $request, $id)
    {
        $request->validate([
            'aprasymas'=>'required',

        ]);

        $share = RecordTest::find($id);
        $share->aprasymas = $request->get('aprasymas');
        $share->save();
        return redirect('/db')->with('success', 'Stock has been added');
    }










    public function store(Request $request)
    {

    }
    public function nukreipymas($id)
    {
        $record = Record::find($id);

        return view('dbedit', compact('record'));
    }
    public function nukreipymas2($id)
    {
        $recor = RecordTest::find($id);

        return view('prasitestavimasedit', compact('recor'));
    }
    public function nukreipymasdelete($id)
    {
        $recor = RecordTest::find($id);
        $recor->delete();

        return redirect('/db')->with('success', 'Stock has been deleted Successfully');
    }
}