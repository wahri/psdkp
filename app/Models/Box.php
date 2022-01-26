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

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
