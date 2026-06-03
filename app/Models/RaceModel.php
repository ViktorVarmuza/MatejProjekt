<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stages;

class RaceModel extends Model
{
    use HasFactory;
    protected $table = 'race';


    public function stages()
    {
        return $this->hasMany(Stages::class, 'id_race_year');
    }
}
