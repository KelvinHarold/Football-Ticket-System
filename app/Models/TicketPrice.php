<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPrice extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'price'];

    public function ticketClass()
    {
        return $this->belongsTo(TicketClass::class, 'class_id');
    }
    
}
