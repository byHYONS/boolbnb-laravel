<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

     //? mass update:
     protected $guarded = ['id'];

     // protected $fillable = [''];


     //? relazione molti a molti con ADS:
     public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    //? relazione uno a molti con USER:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //? relazione uno a molti con MESSAGES:
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //? relazione molti a molti con SERVICES:
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    //? relazione uno a molti con VISUALS:
    public function visuals()
    {
        return $this->hasMany(Visual::class);
    }


}
