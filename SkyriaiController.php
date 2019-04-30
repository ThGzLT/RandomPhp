<?php

namespace Atsargų_likučiai\Http\Controllers;

use Atsargų_likučiai\Skyriai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SkyriaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Skyriai::all();

        return view('skyriai.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shares = Skyriai::all();

        return view('skyriai.create', compact('shares'));
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
            'NAME'=>'required'

        ]);
        $share = new Skyriai([
            'NAME' => $request->get('NAME')

        ]);
        $share->save();
        return redirect('/Skyriai')->with('success', 'Stock has been added');
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
        $share = Skyriai::find($id);

        return view('skyriai.edit', compact('share'));
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
            'NAME'=>'required'

        ]);

        $share = Skyriai::find($id);
        $share->NAME = $request->get('NAME');

        $share->save();

        return redirect('/Skyriai')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $share = Skyriai::find($id);
        $share->delete();

        return redirect('/Skyriai')->with('success', 'Stock has been deleted Successfully');
    }
}
