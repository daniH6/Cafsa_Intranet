<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restringidos;
use Illuminate\Pagination\LengthAwarePaginator;


class RestringidosController extends Controller
{
    public function index(Request $request) {
    // Obtener parámetros de búsqueda
    $field = $request->input('field', 'identificacion'); // 'dni' es el valor por defecto
    $search = $request->input('search');

    // Validar que el campo sea válido (opcional pero recomendado)
    $validFields = ['identificacion', 'name'];
    
    if (!in_array($field, $validFields)) {
        $field = 'identificacion'; // Valor por defecto si el campo no es válido
    }

    // Consulta con filtro dinámico
    $restringidos = Restringidos::query()
        ->when($search, function ($query) use ($field, $search) {
            return $query->where($field, 'like', "%{$search}%");
        })
        ->paginate(10);

    return view('dashboard', compact('restringidos'));
    }

}