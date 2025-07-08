<?php

namespace App\Http\Controllers;

use App\Models\ReporteConducta;
use Illuminate\Http\Request;
use App\Http\Requests\ReporteConductaRequest;

class ReporteConductaController extends Controller
{
    
    public function submit(ReporteConductaRequest $request) {
        
        ReporteConducta::create([
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            'message' => $request->input('message'),
        ]);
        
        return to_route('reporteConductas');
    }
}
