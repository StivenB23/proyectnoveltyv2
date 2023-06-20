<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ["number_classroom","user_id"];
    public function novelties()
    {
        return $this->hasMany(Novelty::class)->orderBy('date_novelty', 'desc');
    }
    public function user()
    {
      return $this->hasOne(User::class, 'id', 'user_id');
    }
}
