<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintNoteFile extends Model
{
    protected $fillable = [
        'complaint_note_id',
        'path', 'type'
    ];

    /**
     * Get the complaintNotes that owns the ComplaintNoteFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaintNote(): BelongsTo
    {
        return $this->belongsTo(ComplaintNote::class);
    }
}
