<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalNotesModel extends Model
{
    use HasFactory;
    protected $table = 'approval_notes';
    protected $primaryKey = 'id_note';
    public $timestamps = true;

    protected $fillable = ['id_reservations', 'approver_id', 'note'];

    public function reservation()
    {
        return $this->belongsTo(ReservationModel::class, 'id_reservations', 'id_reservations');
    }
}
