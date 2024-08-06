<?php

namespace App\Models;

use App\Http\Controllers\LeavesController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VacationType extends Model
{
    use HasFactory;

    protected $table = 'vacation_types';

    protected $guarded = ["id"];


    public function leaves():HasMany{
        return $this->hasMany(LeavesController::class,"vacation_type_id","id");
    }

    public function scopeSearch($query, $search){
        return $query->where('label', 'like', '%'.$search.'%');
    }
}
