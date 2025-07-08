<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TipoCambioController;
use App\Http\Controllers\ChartJSController;

class MainPageController extends Controller
{
    /**
     * Write code on Method
     *
     * @return View
     */
    
    public function Main()
    {
        
        $tCambio = new TipoCambioController();
        $users = new ChartJSController();
        
        $dCambio = $tCambio->index();
        $dUsers = $users->index();
        
        return view('welcome', [
            'dUsers' => $dUsers,
            'dCambio' => $dCambio,
        ]);
    }
}
