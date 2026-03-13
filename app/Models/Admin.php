<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = ['name','email','password','avatar'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['password' => 'hashed'];

    public function getAvatarUrlAttribute(): string {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=6C63FF&color=fff';
    }
}