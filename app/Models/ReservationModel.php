<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ReservationModel extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $primaryKey = 'id_reservations';
    public $timestamps = true;
    protected $fillable = ['id_users', 'id_vehicles', 'id_drivers', 'start_date', 'end_date','approver_id','purpose', 'admin_approval', 'affirmation_approval'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehiclesModel::class, 'id_vehicles', 'id_vehicles');
    }

    public function driver()
    {
        return $this->belongsTo(DriversModel::class, 'id_drivers', 'id_drivers');
    }

    public function approvalNotes()
    {
        return $this->hasMany(ApprovalNotesModel::class, 'id_reservations', 'id_reservations');
    }
}
