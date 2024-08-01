<?php

namespace App\Models;

use App\Http\Controllers\LeavesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveStatus extends Model
{
    use HasFactory;

    protected $table ="leave_status";
    protected $guarded = [""];


    public function leaves():HasMany{
        return $this->hasMany(LeavesController::class,"leave_status_id","id");
    }

}
