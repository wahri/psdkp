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

    public static $updateRules = [
        'code' => 'required',
    ];

    public static $updateMessages = [
        'code.required' => 'Kode tidak boleh kosong!',
    ];

    public static function updateRack($request, $id)
    {
        $rack = self::findOrFail($id);
        $rack->code = $request['code'];
        if ($rack->save()) {
            return true;
        }
        return false;
    }


    public static function getRackDetail($id)
    {
        $rack = self::where('id', $id)
            ->first();
        return $rack;
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
