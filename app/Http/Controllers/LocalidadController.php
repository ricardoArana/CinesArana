<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocalidadRequest;
use App\Http\Requests\UpdateLocalidadRequest;
use App\Models\Localidad;

class LocalidadController extends Controller
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
     * @param  \App\Http\Requests\StoreLocalidadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalidadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function show(Localidad $localidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Localidad $localidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocalidadRequest  $request
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalidadRequest $request, Localidad $localidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localidad $localidad)
    {
        //
    }
}
