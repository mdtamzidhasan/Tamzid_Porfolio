<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [
        'title','description','long_description','image','category',
        'tech_stack','live_url','github_url','is_featured','sort_order','is_active'
    ];
    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeFeatured($query) { return $query->where('is_featured', true); }

    public function getTechArrayAttribute(): array {
        return array_map('trim', explode(',', $this->tech_stack ?? ''));
    }
    public function getImageUrlAttribute(): ?string {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}