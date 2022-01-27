<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    use HasFactory;

    protected $table = 'lockers';

    protected $guarded = "id";

    public static $rules = [
        'code' => 'required',
    ];

    public static $messages = [
        'code.required' => 'Kode tidak boleh kosong!',
    ];

    public static function saveLocker($request,$id)
    {

        $locker = new self;
        $locker->code = $request['code'];
        $locker->room_id = $id;
        if ( $locker->save()) {
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

    public static function updateLocker($request, $id)
    {
        $locker = self::findOrFail($id);
        $locker->code = $request['code'];
        if ($locker->save()) {
            return true;
        }
        return false;
    }


    public static function getLockerDetail($id)
    {
        $locker = self::where('id', $id)
            ->first();
        return $locker;
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }
}
