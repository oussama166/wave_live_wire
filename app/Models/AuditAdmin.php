<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditAdmin extends Model
{
    use HasFactory;

    protected $table = 'audit_admin';

    protected $guarded = ['id'];

    public function Audit(): BelongsTo
    {
        return $this->belongsTo(Audit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // scope
    /**
     * Scope to select specific values from JSON columns.
     *
     * @param Builder $query
     * @param string $jsonColumn The JSON column name.
     * @param array $keys The keys to extract from the JSON structure.
     * @return Builder
     */
    public function scopeSelectJsonValues(
        Builder $query,
        string $jsonColumn,
        array $keys
    ): Builder {
        $query->select('audit_admin.*'); // Ensure all columns are selected

        foreach ($keys as $key) {
            $query->addSelect([
                $key => \DB::raw(
                    "JSON_UNQUOTE(JSON_EXTRACT({$jsonColumn}, '$.{$key}')) as {$jsonColumn}_{$key}"
                ),
            ]);
        }

        return $query;
    }
}
