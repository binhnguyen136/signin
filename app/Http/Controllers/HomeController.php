<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Auth;
use Hash;

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

    public function change_pass_index()
    {
        $userInfo = Auth::user();

        return view('password')->with('userInfo', $userInfo);
    }

    public function change_pass(Request $request)
    {
        $user = Auth::user();

        $updateData = $request->all();
        
        if ($request->confirm_password != $request->password) {
            return redirect()->back()->withErrors('Password confirm not matches');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('message', 'Updated infomation successfully');
    }
}