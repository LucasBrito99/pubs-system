<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pub;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pubs = Pub::with('user')->orderBy("pos")->get();
        $num_pubs = Pub::where('user_id', Auth::id())->count("user_id");

        return view('home',[
            'pubs' => $pubs,
            'num_pubs' => $num_pubs
        ]);
    }

}
