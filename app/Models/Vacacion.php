<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'vacacion';

    protected $primaryKey = 'idVacacion';

    protected $fillable = ['id','fechaInicio','fechaFin'];
}
