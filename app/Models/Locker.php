<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }
}
