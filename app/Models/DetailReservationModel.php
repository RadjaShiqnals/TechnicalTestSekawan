<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReservationModel extends Model
{
    use HasFactory;
    protected $table = 'detail_reservations';
    protected $primaryKey = 'id_detail_reservations';
    public $timestamps = true;
    protected $fillable = ['id_reservations', 'fuel_consumption', 'note'];
    public function reservation()
    {
        return $this->belongsTo(ReservationModel::class, 'id_reservations', 'id_reservations');
    }
}
