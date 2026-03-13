<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {
    protected $fillable = [
        'title','issuer','image','credential_url',
        'issue_date','expiry_date','category','sort_order','is_active'
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function getImageUrlAttribute(): string {
        return asset('storage/' . $this->image);
    }
}