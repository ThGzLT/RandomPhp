<?php

namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Skyriai;
use Atsargų_likučiai\User;
use Atsargų_likučiai\VartotojasSkyrius;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class VartotojasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = User::all();


        return view('users.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shares = VartotojasSkyrius::all();
        $shar = User::all();
        $skyrius = Skyriai::all();
        $sharess = Skyriai::all();

        return view('users.create', compact('shares', 'shar', 'skyrius', 'sharess'));
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
            'name'=>'required',
            'surname'=>'required',
            'email'=> 'required',
            'password' => 'required'
        ]);
        $share = new User([
            'name' => $request->get('name'),
            'surname'=> $request->get('surname'),
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        ]);
        $share->name = Input::get('name');

        $share->password = Hash::make(Input::get('password'));
        $share->save();

        $request->validate([
            'VartotojoID'=>'required',
            'SkyriausID'=> 'required'

        ]);

        $VSK = new VartotojasSkyrius([
            'VartotojoID' => $request->get('VartotojoID'),
            'SkyriausID'=> $request->get('SkyriausID')

        ]);
        $VSK->save();



        return redirect('/Vartotojas')->with('success', 'Stock has been added');
    }

    public function store2(Request $request)
    {

        $request->validate([
            'VartotojoID'=>'required',
            'SkyriausID'=> 'required'

        ]);

        $VSK = new VartotojasSkyrius([
            'VartotojoID' => $request->get('VartotojoID'),
            'SkyriausID'=> $request->get('SkyriausID')

        ]);
        $VSK->save();


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
        $share = User::find($id);

        return view('users.edit', compact('share'));
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
            'name'=>'required',
            'surname'=>'required',
            'email'=> 'required',
            'password' => 'required'
        ]);

        $share = User::find($id);
        $share->name = $request->get('name');
        $share->surname = $request->get('surname');
        $share->email = $request->get('email');
        $share->password = $request->get('password');
        $share->name = Input::get('name');

        $share->password = Hash::make(Input::get('password'));
        $share->save();

        return redirect('/Vartotojas')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $share = User::find($id);
        $share->delete();

        return redirect('/Vartotojas')->with('success', 'Stock has been deleted Successfully');
    }
}
