<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
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
        $noticias = Noticia::orderBy('idNoticia', 'desc')->take(4)->get();
        return view('welcome')->with('noticias', $noticias);
    }
    public function quienessomos()
    {
        return view('quienessomos');
    }
    public function contactanos()
    {
        return view('contactanos');
    }
}
