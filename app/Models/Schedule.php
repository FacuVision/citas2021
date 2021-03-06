<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Doctor;
use App\Models\Meeting;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = [];
    //UN HORARIO LE PERTENECE A UN SOLO DOCTOR
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    //UN HORARIO PUEDE TENER MUCHAS CITAS REGISTRADAS A SU ID
    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }

}
