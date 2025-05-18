<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'class_id', 'ticket_code', 'transaction_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketClass()
    {
        return $this->belongsTo(TicketClass::class, 'class_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function bookingHistories()
    {
        return $this->hasMany(BookingHistory::class);
    }
}
