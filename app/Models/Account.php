<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    const REPORTED = 0;
    const REPORT_NEW = 1;
    const REPORT_REMOVED = 2;

    protected $fillable = [
        "device_id",  # type: int
        "username",  # type: text
        "password",  # type: text
        "action",  # type: enum {REPORTED, REPORT_NEW, REPORT_REMOVED}
        "start_at",  # type: datetime
        "end_at",  # type: datetime
        "server_side",  # type: bool
    ];

    public function device(){
        return $this->belongsTo(Device::class);
    }
}
