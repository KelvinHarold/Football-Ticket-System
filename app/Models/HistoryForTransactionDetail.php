<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryForTransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'status', 'notes'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
