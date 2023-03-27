<?php

namespace App\Http\Controllers;

use App\Models\Virement;
use App\Http\Requests\StoreVirementRequest;
use App\Http\Requests\UpdateVirementRequest;

class VirementController extends Controller
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
     * @param  \App\Http\Requests\StoreVirementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVirementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function show(Virement $virement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function edit(Virement $virement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVirementRequest  $request
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVirementRequest $request, Virement $virement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Virement  $virement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Virement $virement)
    {
        //
    }
}
