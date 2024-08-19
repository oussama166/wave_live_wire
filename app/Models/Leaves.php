<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

class Leaves extends Model
{
    use HasFactory;

    protected $table = 'leaves';
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leaveStatus(): BelongsTo
    {
        return $this->belongsTo(LeaveStatus::class);
    }

    public function vacationType(): BelongsTo
    {
        return $this->belongsTo(VacationType::class);
    }

    public function scopeSearch(Builder $query, ?string $searchText)
    {
        $searchText = "%{$searchText}%";
        $query->where(function (Builder $query) use ($searchText) {
            $query
                ->where('start_at', 'like', $searchText)
                ->orWhere('end_at', 'like', $searchText)
                ->orWhere('description', 'like', $searchText)
                ->orWhereHas('user', function (Builder $query) use (
                    $searchText
                ) {
                    $query->where('name', 'like', $searchText)
                        ->orWhere('lastname', 'like', $searchText);
                })
                ->orWhereHas('leaveStatus', function (Builder $query) use (
                    $searchText
                ) {
                    $query->where('label', 'like', $searchText);
                });
        });
    }
}
