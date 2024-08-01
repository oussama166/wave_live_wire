<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nationality extends Model
{
    use HasFactory;

    protected $table = 'nationalities';

    protected $guarded = ["id"];

    // Relation btw models
    // Relation btw User

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
