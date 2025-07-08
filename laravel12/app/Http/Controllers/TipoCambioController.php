<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class TipoCambioController extends Controller
{
    /**
     * Write code on Method
     *
     * @return View
     */
    
    public function index() {
        $response = Http::get('https://ibanking.cafsa.fi.cr/app/obtenerTIpoCambio');
        $data = $response->json();
        return ($data);
    }
    
    public function data() {
        $response = Http::get('https://ibanking.cafsa.fi.cr/app/obtenerTIpoCambio');
        $data = $response->json();
        return view('dashboard', [
            'data' => $data
        ]);
    }
}
