<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public static $rules = [
        'name' => 'required',
    ];

    public static $messages = [
        'name.required' => 'Nama tidak boleh kosong!',
    ];

    public static function saveRoom($request)
    {

        $room = new self;
        $room->name = $request['name'];
        if ($room->save()) {
            return true;
        }

        return false;
    }

    public function lockers()
    {
        return $this->hasMany(Locker::class);
    }
}
