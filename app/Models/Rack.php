<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
}
