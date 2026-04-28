<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;

    public $table = 'site_settings';

    protected $appends = [
        'logo',
        'footer_logo',
        'favicon',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'site_name',
        'site_title',
        'tagline',
        'email',
        'phone',
        'alternate_phone',
        'whatsapp_number',
        'address',
        'map_url',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'copyright_text',
        'status',
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
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('footer_logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }

    public function getLogoAttribute()
    {
        return $this->getMedia('logo')->last();
    }

    public function getFooterLogoAttribute()
    {
        return $this->getMedia('footer_logo')->last();
    }

    public function getFaviconAttribute()
    {
        return $this->getMedia('favicon')->last();
    }
}