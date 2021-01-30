<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KyslikColumnSortableSortable;

class Catalogo extends Model
{

    protected $fillable = ['titulo','autor','editorial','anopub' ?? NULL,'ejemplar' ?? NULL,'isbn', 'ubicacion' ?? NULL, 'disponibilidad' ?? NULL];
    use HasFactory;
}
