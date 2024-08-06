<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",  # type: int
        "status",  # type: bool
        "name",  # type: text
        "ssid",  # type: text
        "password",  # type: text
        "imei",  # type: text
        "ups_status",  # type: bool
        "door_status",  # type: bool
        "relay_module",  # type: bool
        "relay_module_terminal",  # type: tinyint
        "lock_status1",  # type: bool
        "lock_status2",  # type: bool
        "bat_status",  # type: int
        "rssi",  # type: int
        "alarm_status",  # type: bool
        "temperature",  # type: float
        "alive_at",  # type: datetime
        "door_status_updated",  # type: bool
        "alarm_status_updated",  # type: bool
        "terminal1_title",  # type: text
        "terminal2_title",  # type: text
        "terminal3_title",  # type: text
        "terminal4_title",  # type: text
        "terminal5_title",  # type: text
        "terminal6_title",  # type: text
        "terminal7_title",  # type: text
        "terminal8_title",  # type: text
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function accounts(){
        return $this->hasMany(Account::class);
    }

    public function alive(){
        $this->update([
            'status' => true,
            'alive_at' => date("Y-m-d H:i:s"),
        ]);
    }
    public function hasAlive(){
        // return true; // for test
        $alive = time() - 60 <= strtotime($this->alive_at);
        if(!$alive && $this->status){
            $this->update([
                'status' => false,
            ]);
        }
        return $alive;
    }
}
