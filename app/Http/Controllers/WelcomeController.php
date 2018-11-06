<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = DB::select('CALL sp_consultarUltimasNoticia()');
        return view('welcome')->with('noticias', $noticias);
    }
}
