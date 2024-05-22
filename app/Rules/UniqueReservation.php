<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Reservation;

class UniqueReservation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $laboratoryId;
    protected $startTime;
    protected $endTime;

    public function __construct($laboratoryId, $startTime, $endTime)
    {
        $this->laboratoryId = $laboratoryId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    // Validación personalizada para asegurar que no haya reservas en el mismo laboratorio y tiempo
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $reservation = Reservation::where('laboratory_id', $this->laboratoryId)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->startTime, $this->endTime])
                    ->orWhereBetween('end_time', [$this->startTime, $this->endTime]);
            })
            ->exists();
        if ($reservation) {
            $fail('Another reservation already exists for the same laboratory and time interval.');
        }
        
    }
}
