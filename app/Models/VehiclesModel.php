<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class VehiclesModel extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $primaryKey = 'id_vehicles';
    public $timestamps = true;
    protected $fillable = ['plate_number', 'model', 'ownership', 'status', 'locations'];

    public function reservations()
    {
        return $this->hasMany(ReservationModel::class, 'id_vehicles', 'id_vehicles');
    }
}
