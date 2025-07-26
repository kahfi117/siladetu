<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintNote extends Model
{
    protected $fillable = [
        'complaint_id', 'created_by',
        'note'
    ];

    /**
     * Get the createdBy that owns the ComplaintNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the complaint that owns the ComplaintNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }
}
