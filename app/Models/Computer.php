<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    public function classroom()
    {
        return $this->hasOne("App\Models\Classroom","id","classroom_id");
    }
}
