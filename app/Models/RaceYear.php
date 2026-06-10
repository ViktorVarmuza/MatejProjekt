<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaceYear extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'race_year';

    protected $fillable = [
        'race_id',
        'real_name',
        'start_date',
        'end_date',
        'year',
        'sex',
        'uci_tour',
        'country',
        'logo', // zde bude uložená cesta k souboru
    ];

    //co muzu vlozit do databaze, co je povoleno, aby se nestalo, ze vlozim neco, co tam nechci

    public function stages()
    {
        return $this->hasMany(Stages::class, 'id_race_year');
    }
    //relace mezi tabulkami, jeden závod může mít více etap, takže použijeme hasMany
}
