<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentArchiveInfo extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public function documentArchive()
    {
        return $this->belongsTo(DocumentArchive::class);
    }
    public function inputFormat()
    {
        return $this->belongsTo(InputFormat::class);
    }
}
