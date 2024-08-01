<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperienceLevels extends Model
{
    use HasFactory;

    protected $table = "experience_levels";

    protected $guarded = ["id"];


    // Relation btw models
    // Relation btw User

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
