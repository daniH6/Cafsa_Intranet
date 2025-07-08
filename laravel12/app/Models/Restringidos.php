<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restringidos extends Model
{
    /** @use HasFactory<\Database\Factories\RestringidosFactory> */
    use HasFactory;
    
    /** 
     * The attributes that are mass assignable.
     *
     * @var array<string>
    */
    
    protected $table = 'restringidos';
    
    protected $fillable = [
        'identificacion',
        'nombre',
        'date',
        'direction',
        'telephone',
        'email',
        'description',
    ];
    
}
