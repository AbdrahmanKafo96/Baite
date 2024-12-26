<?php

namespace App\Http\Controllers;

use App\Models\myService;
use App\Http\Requests\StoremyServiceRequest;
use App\Http\Requests\UpdatemyServiceRequest;

class MyServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremyServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(myService $myService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(myService $myService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemyServiceRequest $request, myService $myService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(myService $myService)
    {
        //
    }
}
