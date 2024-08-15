<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Audit extends Model
{

    use HasFactory;

    protected $table = "audit";
    protected $guarded = ["id","updated_at"];


    public function AuditUser(): HasMany
    {
        return $this->hasMany(AuditUser::class);
    }

    public function AuditAdmin(): HasMany
    {
        return $this->hasMany(AuditAdmin::class);
    }
}
