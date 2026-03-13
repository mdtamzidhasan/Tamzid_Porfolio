<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
    protected $fillable = [
        'name','title','tagline','bio','email','phone','location',
        'profile_photo','cv_file','github','linkedin','twitter','facebook',
        'projects_count','years_experience','clients_count','github_stars','available_for_work'
    ];
    protected $casts = ['available_for_work' => 'boolean'];

    public function getTaglinesAttribute(): array {
        return array_map('trim', explode(',', $this->tagline ?? ''));
    }
    public function getProfilePhotoUrlAttribute(): string {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }
    public function getCvUrlAttribute(): ?string {
        return $this->cv_file ? asset('storage/' . $this->cv_file) : null;
    }
}