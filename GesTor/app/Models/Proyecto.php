<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $primaryKey = 'id_proyecto';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_limite',
        'num_integrantes',
        'num_tareas',
        'id_usuario'
    ];

    public $timestamps = true;
}