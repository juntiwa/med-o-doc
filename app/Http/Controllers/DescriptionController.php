<?php

namespace App\Http\Controllers;

use App\Models\Letterreg;
use App\Models\Lettersend;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'abilities']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('decription');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idTitle)
    {
        $registerFound = Letterreg::where('regrecid', $idTitle)->first();
        $descriptions = Lettersend::leftJoin('letterrecs', 'lettersends.sendregid', '=', 'letterrecs.sendregid')
        ->where('lettersends.regrecid', $idTitle)
        ->orderby('letterrecs.recdate', 'desc')
        ->paginate(50);

        $title = $registerFound->regtitle;
        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'ดูข้อมูลเพิ่มเติม เรื่อง '.$title;
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('Y-m-d H:i:s');

        LogActivity::insert($validated);


        return view('decription', ['registerFound' => $registerFound, 'descriptions' => $descriptions]);
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
