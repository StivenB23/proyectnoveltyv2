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
        'computer_id',
        'type',
        'user_id',
        'classroom_id',
    ];

    public function images()
    {
        return $this->hasMany("App\Models\Image", "novelty_id", "id");
    }

    public function computer()
    {
        return $this->hasOne("App\Models\Computer", "id", "computer_id");
    }

    public function classroom()
    {
        return $this->hasOne("App\Models\Classroom", "id", "classroom_id");
    }
    public function instructor()
    {
        return $this->hasOne("App\Models\User", "id", "user_id");
    }
    
}
