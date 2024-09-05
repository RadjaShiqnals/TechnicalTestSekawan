<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversModel extends Model
{
    use HasFactory;
    protected $table = 'drivers';
    protected $primaryKey = 'id_drivers';
    public $timestamps = true;
    protected $fillable = ['name', 'status'];

    public function reservations()
    {
        return $this->hasMany(ReservationModel::class, 'id_drivers', 'id_drivers');
    }
}
