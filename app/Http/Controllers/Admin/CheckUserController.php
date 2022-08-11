<?php

namespace App\Http\Controllers\Admin;

use App\APIs\CheckAccountAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'abilities', 'admin']);
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CheckAccountAPI $api)
    {
        // $checkExistAcc = $api->checkexist($request->sapid);

        // return $checkExistAcc;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CheckAccountAPI $api)
    {
        $checkAcc = $api->checkuser($request->sapid);

        return $checkAcc;
        /* return [
           'Status' => 'Active',
           'AcountName' => 'juntima.nuc'
        ]; */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
