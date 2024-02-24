<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');

        //         // modelのItemから全てのデータを受け取る
        //         $items = Item::paginate(6);
        //         // viewのItemにデータを受け渡す

        // return view('item.used_item', compact('items'));
                        $auth_user = Auth::user();

                        $items = Item::all();

        return view('home', compact('items','auth_user'));
    }
}
