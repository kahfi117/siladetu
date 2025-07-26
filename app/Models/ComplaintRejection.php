<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintRejection extends Model
{
    protected $fillable = [
        'complaint_id',
        'note',
        'rejection_by'
    ];

    /**
     * Get the complaint that owns the ComplaintRejection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Get the rejectionBy that owns the ComplaintRejection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rejectionBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
