<?php

namespace Atsargų_likučiai\Http\Controllers;
use Atsargų_likučiai\Skyriai;

use Atsargų_likučiai\User;
use Atsargų_likučiai\VartotojasSkyrius;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VartotojasSkyriusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = VartotojasSkyrius::all();
        $shar = User::all();
        $skyrius = Skyriai::all();

        return view('Vartotojas_skyrius.index', compact('shares', 'shar', 'skyrius'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shares = User::all();
        $sharess = Skyriai::all();

        return view('Vartotojas_skyrius.create', compact('shares', 'sharess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'VartotojoID'=>'required',
            'SkyriausID'=> 'required'

        ]);
        $share = new VartotojasSkyrius([
            'VartotojoID' => $request->get('VartotojoID'),
            'SkyriausID'=> $request->get('SkyriausID')

        ]);
        $share->save();
        return redirect('/VartotojasSkyrius')->with('success', 'Stock has been added');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shares = User::all();
        $sharess = Skyriai::all();
        $share = VartotojasSkyrius::find($id);

        return view('Vartotojas_skyrius.edit', compact('share', 'shares', 'sharess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'VartotojoID'=>'required',
            'SkyriausID'=> 'required'
        ]);

        $share = VartotojasSkyrius::find($id);
        $share->VartotojoID = $request->get('VartotojoID');
        $share->SkyriausID = $request->get('SkyriausID');
        $share->save();

        return redirect('/VartotojasSkyrius')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $share = VartotojasSkyrius::find($id);
        $share->delete();

        return redirect('/VartotojasSkyrius')->with('success', 'Stock has been deleted Successfully');
    }


}
