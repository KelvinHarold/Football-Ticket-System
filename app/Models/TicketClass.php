<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketClass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function prices()
    {
        return $this->hasMany(TicketPrice::class, 'class_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'class_id');
    }
    public function price()
{
    return $this->hasOne(TicketPrice::class, 'class_id');
}

}
