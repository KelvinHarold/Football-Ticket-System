<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastMatch extends Model
{
    use HasFactory;
    protected $table = 'pastmatches'; // Specify the table name if different from the model name
    protected $fillable = ['home_team', 'away_team', 'match_date', 'result', 'stadium'];
}
