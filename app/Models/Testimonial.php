<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = [
        'client_name','client_title','company','client_photo',
        'review','rating','sort_order','is_active'
    ];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeActive($query) { return $query->where('is_active', true); }
    public function getPhotoUrlAttribute(): string {
        return $this->client_photo
            ? asset('storage/' . $this->client_photo)
            : asset('images/default-avatar.png');
    }
}