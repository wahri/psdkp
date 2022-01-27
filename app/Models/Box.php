<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $table = 'boxes';

    protected $guarded = "id";

    public static $rules = [
        'code' => 'required',
        'rack_id' => 'required',
    ];

    public static $messages = [
        'code.required' => 'Kode tidak boleh kosong!',
    ];

    public static function saveBox($request)
    {

        $box = new self;
        $box->code = $request['code'];
        $box->rack_id = $request['rack_id'];
        if ( $box->save()) {
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

    public static function updateBox($request, $id)
    {
        $box = self::findOrFail($id);
        $box->code = $request['code'];
        if ($box->save()) {
            return true;
        }
        return false;
    }


    public static function getBoxDetail($id)
    {
        $box = self::where('id', $id)
            ->first();
        return $box;
    }


    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
