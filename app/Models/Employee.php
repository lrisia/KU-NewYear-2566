<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function organizer() {
        return $this->belongsTo(Organizer::class);
    }

    public function prize() {

    }

    public function scopeSearchName($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%");
    }

    public function scopeNotRegister($query) {
        return $query->whereNull('register_at');
    }
}
