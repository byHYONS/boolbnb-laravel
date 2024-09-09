<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visual extends Model
{
    use HasFactory;

    //? relazione molti a molti con HOMES:
    public function home()
    {
        return $this->belongsTo(Home::class);
    }
}