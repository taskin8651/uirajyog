<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Certificate extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    public $table = 'certificates';

    protected $appends = [
        'pdf',
        'file_type',
        'file_url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'short_description',
        'status',
        'sort_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pdf')->singleFile();
    }

    public function getPdfAttribute()
    {
        return $this->getMedia('pdf')->last();
    }

    public function getFileUrlAttribute()
    {
        return $this->pdf ? $this->pdf->getUrl() : null;
    }

    public function getFileTypeAttribute()
    {
        if (! $this->pdf) {
            return null;
        }

        $mimeType = $this->pdf->mime_type;

        if ($mimeType === 'application/pdf') {
            return 'pdf';
        }

        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        return 'file';
    }
}