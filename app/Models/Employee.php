<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'register_at' => 'datetime',
        'arrive_at' => 'datetime',
        'got_prize_at' => 'datetime'
    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }

    public function scopeSearchName($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%");
    }

    public function scopeSearchAllColumn($query, $search)
    {
        return $query->join('organizers', 'organizers.id', '=', 'employees.organizer_id')
            ->select('employees.*', 'organizers.name as organizer_name')
            ->where('employees.name', 'LIKE', "%{$search}%")
            ->orWhere('employees.email', 'LIKE', "%{$search}%")
            ->orWhere('organizers.name', 'LIKE', "%{$search}%");
    }

    public function scopeNotRegister($query)
    {
        return $query->whereNull('register_at');
    }

    public function timeFormat($time) {
        $month = ['Jan' => 'มกราคม', 'Feb' => 'กุมภาพันธ์', 'Mar' => 'มีนาคม',
            'Apr' => 'เมษายน', 'May' => 'พฤษภาคม', 'Jun' => 'มิถุนายน',
            'Jul' => 'กรกฎาคม', 'Aug' => 'สิงหาคม', 'Sep' => 'กันยายน',
            'Oct' => 'ตุลาคม', 'Nov' => 'พฤศจิกายน', 'Dec' => 'ธันวาคม'];
        $time_converted = $time->format('d M H:i:s');
        $time_month = $time->format('M');
        return str_replace($time_month, $month[$time_month], $time_converted);
    }
}
