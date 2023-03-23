<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use App\Http\Requests\StoreSalaireRequest;
use App\Http\Requests\UpdateSalaireRequest;

class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaireRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function show(Salaire $salaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Salaire $salaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaireRequest  $request
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaireRequest $request, Salaire $salaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salaire $salaire)
    {
        //
    }
}
