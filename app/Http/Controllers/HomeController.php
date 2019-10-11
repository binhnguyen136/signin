<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userInfo = Auth::user();

        return view('home')->with('userInfo', $userInfo);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $updateData = $request->all();
        $user->update($updateData);

        return redirect()->back()->with('message', 'Updated infomation successfully');
    }
}
