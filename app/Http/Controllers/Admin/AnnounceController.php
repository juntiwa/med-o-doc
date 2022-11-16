<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Models\announce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AnnounceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $announces = announce::all();

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'เข้าหน้าข่าวประกาศ';
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('Y-m-d H:i:s');
        LogActivity::insert($validated);

        return view('admin.announce.announce',['announces' => $announces]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'topic_announces' => 'required',
            //'statuses' => 'required',
        ]);

        $validate['statuses'] = "false";
        
        announce::create($validate);

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'สร้างข่าวประกาศ';
        $validated['type'] = 'create';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('Y-m-d H:i:s');
        LogActivity::insert($validated);

        return redirect()->route('announces');
    }

    public function updateStatus(Request $request,$id)
    {
        $validate = $request->validate([
            'statuses' => 'required'
        ]);

        announce::where(['id' => $id])->update($validate);

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'แก้ไขสถานะข่าวประกาศ';
        $validated['type'] = 'update';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('Y-m-d H:i:s');
        LogActivity::insert($validated);

        return redirect()->route('announces');
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'topic_announces' => 'required'
        ]);

        announce::where(['id' => $id])->update($validate);

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'แก้ไขเนื้อหาข่าวประกาศ';
        $validated['type'] = 'update';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('Y-m-d H:i:s');
        LogActivity::insert($validated);

        return redirect()->route('announces');
    }
}
