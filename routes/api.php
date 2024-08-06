<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

# input flag: [status] [name] [ssid] [password] [ups_status] [door_status] [relay_module] [relay_module_termainal] [lock_status1] [lock_status2] [bat_status] [rssi] [alarm_status] [temperature]
# output flag: [success]
Route::get('/set/{imei}', [ApiController::class, "set"]);

# input flag: none
# output flag: [success] [accounts action] [status] [name] [ssid] [password] [ups_status] [door_status] [relay_module] [relay_module_termainal] [lock_status1] [lock_status2] [bat_status] [rssi] [alarm_status] [temperature] [created at] [updated at]
Route::get('/get/{imei}', [ApiController::class, "get"]);

# input flag: none
# output flag: [exists] [enum {new, remove}] [username] [password] [start_date] [end_date] [updated at]
Route::get('/user/{imei}', [ApiController::class, "user"]);

# input flag: [enum {new, remove}] [username] [password] [start_date] [end_date]
# output flag: [success]
Route::get('/updateuser/{imei}', [ApiController::class, "updateuser"]);

# input flag: [username] [field] [value] [updated_at]
# output flag: [success]
Route::get('/log/{imei}', [ApiController::class, "log"]);

# input flag: none
# output flag: [success]
Route::get('/alive/{imei}', [ApiController::class, "alive"]);

# input flag: none
# output flag: [success]
Route::get('/alive/{imei}', [ApiController::class, "alive"]);

# input flag: none
# output flag: [success]
Route::get('/doorStatusUpdated/{imei}', [ApiController::class, "doorStatusUpdated"]);

# input flag: none
# output flag: [success]
Route::get('/alarmStatusUpdated/{imei}', [ApiController::class, "alarmStatusUpdated"]);
