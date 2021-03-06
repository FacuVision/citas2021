<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Schedule;
use App\Models\Speciality;
use App\Models\User;

class Meeting extends Model
{
    use HasFactory;
    protected $guarded = [];
    //UNA CITA PERTENECE A UN SOLO HORARIO
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    //UN CITA LE PERTECE A UNA SOLA ESPECIALIDAD
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    //UNA CITA LE PERTENECE A UN SOLO USUARIO
    public function user(){
        return $this->belongsTo(User::class);
    }
}
