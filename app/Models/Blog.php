<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model {
    protected $fillable = [
        'title','slug','excerpt','content','thumbnail','category',
        'tags','read_time','is_published','published_at','is_featured'
    ];
    protected $casts = [
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query) { return $query->where('is_published', true); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }

    public function getTagsArrayAttribute(): array {
        return array_map('trim', explode(',', $this->tags ?? ''));
    }
    public function getThumbnailUrlAttribute(): ?string {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($blog) {
            if (!$blog->slug) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }
}