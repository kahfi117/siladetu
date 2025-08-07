<?php

namespace App\Models;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\Commentions\Contracts\Commentable;
use Kirschbaum\Commentions\HasComments;
use Str;

class Complaint extends Model implements Commentable
{
    use SoftDeletes;
    use HasComments;

    protected $fillable = [
        'code', 'subject', 'complainant',
        'anonim', 'description', 'location',
        'complaint_type_id', 'complaint_status',
        'complaint_prorities', 'assigned_to',
        'proof_of_complaint'
    ];

    protected $casts = [
        'anonim' => 'boolean',
        'complaint_status' => StatusEnum::class,
        'complaint_prorities' => PriorityEnum::class,
        'proof_of_complaint' => 'array'
    ];

    /**
     * Get all of the complaintFiles for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function complaintFiles(): HasOne
    {
        return $this->hasOne(ComplaintFile::class);
    }

    /**
     * Get the complaintType associated with the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function complaintType(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class);
    }

    /**
     * Get all of the complaintNotes for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaintNotes(): HasMany
    {
        return $this->hasMany(ComplaintNote::class);
    }

    /**
     * Get all of the complaintNoteFiles for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function complaintNoteFiles(): HasManyThrough
    {
        return $this->hasManyThrough(ComplaintNoteFile::class, ComplaintNote::class);
    }

    /**
     * Get the user that owns the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public static function generateUniqueCode($prefix = 'INFRA-', $length = 6)
    {
        do {
            $code = $prefix . strtoupper(Str::random($length));
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
