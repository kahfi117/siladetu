<?php

namespace App\Models;

use GalleryJsonMedia\JsonMedia\Concerns\InteractWithMedia;
use GalleryJsonMedia\JsonMedia\Contracts\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintFile extends Model implements HasMedia
{

    use InteractWithMedia;
    protected $fillable = [
        'complaint_id',
        'path',
        'type'
    ];

    protected $casts = [
        'path' => 'array'
    ];

    protected function getFieldsToDeleteMedia(): array {
        return ['path'];
    }

    /**
     * Get the complaint that owns the ComplaintFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }
}
