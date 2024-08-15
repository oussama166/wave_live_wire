<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditUser extends Model
{
    use HasFactory;

    protected $table = 'audit_user';
    protected $fillable = ["audit_id", "user_id", "old_values", "new_values", "create_at"];

}
