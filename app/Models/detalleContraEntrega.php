<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleContraEntrega extends Model
{
    use HasFactory;
    protected $fillable = [
        'idPedido',
        'idSucProd',
        'precio',
        'cantidad',
        'subtotal'
    ];
}
