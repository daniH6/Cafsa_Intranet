<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->timezone('America/Costa_Rica');
        return view('date.index', compact('date'));
    }
}
