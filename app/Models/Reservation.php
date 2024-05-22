<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_date',
        'start_time',
        'end_time',
        'observations',
        'laboratory_id',
        'user_id',
    ];
    protected $dates = [
        'request_date',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }
}
