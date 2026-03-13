<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model {
    protected $fillable = [
        'job_title','company','company_logo','location',
        'start_date','end_date','is_current','description','sort_order','is_active'
    ];
    protected $casts = ['is_current' => 'boolean', 'is_active' => 'boolean'];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function getEndLabelAttribute(): string {
        return $this->is_current ? 'Present' : ($this->end_date ?? '');
    }
}