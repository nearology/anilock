<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        "device_id",  # type: int
        "organization_id",  # type: int
        "username",  # type: text username of account or user
        "field",  # type: text
        "value",  # type: text
        "server_side",  # type: bool account or user
        "alerted",  # type: bool
        "updated_at",  # type: datetime
    ];

    public function device(){
        return $this->belongsTo(Device::class);
    }
    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function fieldName(){
        return match($this->field){
            "status" => "وضعیت",
            "name" => "نام دستگاه",
            "ssid" => "ssid",
            "password" => "رمز",
            "imei" => "imei",
            "ups_status" => "برق اضطراری",
            "door_status" => "وضعیت درب",
            "relay_module" => "ماژول رله",
            "relay_module_terminal" => "قفل های ماژول",
            "relay_module_terminal1" => $this->device->terminal1_title,
            "relay_module_terminal2" => $this->device->terminal2_title,
            "relay_module_terminal3" => $this->device->terminal3_title,
            "relay_module_terminal4" => $this->device->terminal4_title,
            "relay_module_terminal5" => $this->device->terminal5_title,
            "relay_module_terminal6" => $this->device->terminal6_title,
            "relay_module_terminal7" => $this->device->terminal7_title,
            "relay_module_terminal8" => $this->device->terminal8_title,
            "lock_status1" => "وضعیت قفل 1",
            "lock_status2" => "وضعیت قفل 2",
            "bat_status" => "باطری",
            "rssi" => "rssi",
            "alarm_status" => "وضعیت هشدار",
            "terminal1_title" => "عنوان ماژول 1",
            "terminal2_title" => "عنوان ماژول 2",
            "terminal3_title" => "عنوان ماژول 3",
            "terminal4_title" => "عنوان ماژول 4",
            "terminal5_title" => "عنوان ماژول 5",
            "terminal6_title" => "عنوان ماژول 6",
            "terminal7_title" => "عنوان ماژول 7",
            "terminal8_title" => "عنوان ماژول 8",
            default => $this->field,
        };
    }
}
