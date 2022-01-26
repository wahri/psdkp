<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;

    protected $table = 'racks';

    protected $guarded = "id";

    public static $rules = [
        'code' => 'required',
        'locker_id' => 'required'
    ];

    public static $messages = [
        'code.required' => 'Kode tidak boleh kosong!'
    ];

    public static function saveRack($request)
    {
        $rack = new self;
        $rack->code = $request['code'];
        $rack->locker_id = $request['locker_id'];
        if ( $rack->save()) {
            return true;
        }

        return false;
    }


    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
}
