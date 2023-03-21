<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Novelty extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_novelty',
        'date_resolved',
        'description',
        'details_procces',
        'state',
        'user_id',
        'classroom_id',
    ];
   
}
