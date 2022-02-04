<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentArchive extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function locker()
    {
        return $this->belongsTo(Locker::class);
    }
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function documentInfos()
    {
        return $this->hasMany(DocumentArchiveInfo::class);
    }
}
