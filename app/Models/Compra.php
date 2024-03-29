<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProveedor',
        'estado',
        'fecha_compra',
        'idSucursalEmpleado',
        'IVA'
    ];
}
