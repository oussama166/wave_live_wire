<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leaves extends Model
{
    use HasFactory;


    protected $table = "leaves";
    protected $guarded = ["id"];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function leaveStatus():BelongsTo{
        return $this->belongsTo(LeaveStatus::class);
    }

    public function vacationType():BelongsTo{
        return $this->belongsTo(VacationType::class);
    }
}
