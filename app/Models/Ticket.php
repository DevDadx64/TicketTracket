<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'assigned_to_user_id',
        'created_by_user_id',
        'updated_by_user_id',
//        'status',
        'priority',
    ];


    protected $casts = [
        'status' => \App\Enums\TicketStatus::class,
        'priority' => \App\Enums\TicketPriority::class,
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }
}
