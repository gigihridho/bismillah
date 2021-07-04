<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class Booking implements Rule
{
    protected $room_type;
    protected $new_arrival_date;
    protected $new_departure_date;
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($room_type, $new_arrival_date, $new_departure_date)
    {
        $this->room_type = $room_type;
        $this->new_arrival_date = $new_arrival_date;
        $this->new_departure_date = $new_departure_date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->room_available();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maaf, tidak ada kamar yang tersedia di tanggal ini. Silakan pilih tanggal lain.';
    }

    public function room_available(){
        $this->room_exist();

        foreach ($this->room_type->rooms as $room) {
            if($this->room_bookings_exist($room)){
                if($this->room_bookings_check($room->room_bookings) == false){
                continue;
                }
            }
            return true;
        }
    }

    public function available_room_number(){
        $this->room_exist();
        foreach ($this->room_type->rooms as $room) {
            if($this->room_bookings_exist($room)){
                if($this->room_bookings_check($room->room_bookings) == false)
                continue;
            }
            return $room->room_number;
        }
    }

    protected function room_exist(){
        if(count($this->room_type->rooms) > 0){
            return true;
        }
        $this->message = "Maaf tidak ada kamar yang tersedia";
        return false;
    }

    protected function room_bookings_exist($room){
        if(count($room->room_bookings) > 0){
            return true;
        }
    }

    protected function room_bookings_check($room_bookings)
    {
        foreach ($room_bookings as $room_booking) {
            $old_arrival_date = Carbon::parse($room_booking->arrival_date);
            $old_departure_date = Carbon::parse($room_booking->departure_date);
            if($this->new_arrival_date < $old_arrival_date){
                if($this->new_departure_date > $old_departure_date){
                return false;
                }
            } elseif ($this->new_arrival_date > $old_arrival_date){
                if($this->new_departure_date < $old_departure_date){
                return false;
                }
            } elseif ($this->new_arrival_date == $old_arrival_date){
                return false;
            }
        }
        return true;
    }
}

