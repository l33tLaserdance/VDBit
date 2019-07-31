<?php

namespace App\Http\Controllers\Admin;

use App\scud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scud = scud::all();
		return view('admin.scud.index', compact('scud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.scud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        scud::create($request->all());
		return redirect()->route('admin.scud.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\scud  $scud
     * @return \Illuminate\Http\Response
     */
    public function show(scud $scud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\scud  $scud
     * @return \Illuminate\Http\Response
     */
    public function edit(scud $scud)
    {
        return view('main.scud.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\scud  $scud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, scud $scud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\scud  $scud
     * @return \Illuminate\Http\Response
     */
    public function destroy(scud $scud)
    {
        //
    }
}
