<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Sensor;
use App\Models\Account;
use App\Models\Log;

class ApiController extends Controller
{
    private function encode(string $plain){
        return $plain;
        $key = env('API_KEY');
        $keylen = strlen($key);
        $len = strlen($plain);
        for($i = 0; $i < $len; ++$i){
            $plain[$i] = $plain[$i] ^ $key[$i % $keylen];
        }
        return bin2hex($plain);
    }

    private function decode(string $code){
        return $code;
        try {
            $code = hex2bin($code);
        }catch(\Exception $e){
            $code = false;
        }
        if(!$code){
            return false;
        }
        $key = env('API_KEY');
        $keylen = strlen($key);
        $len = strlen($code);
        for($i = 0; $i < $len; ++$i){
            $code[$i] = $code[$i] ^ $key[$i % $keylen];
        }
        return $code;
    }

    public function set(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $query = $request->input('query', '');
        $query = $this->decode($query);
        if(!$query){
            return $this->encode('0');  # flag: unsuccess
        }
        $query = explode('|', $request->input('query'));
        if(count($query) != 14){
            return $this->encode('0');  # flag: unsuccess
        }
        $device_datas = array_combine([
            'status', 'name', 'ssid', 'password', 'ups_status', 'door_status', 'relay_module', 'relay_module_terminal',
            'lock_status1', 'lock_status2', 'bat_status', 'rssi', 'alarm_status', 'temperature',
        ], $query);
        $device->update($device_datas);
        return $this->encode('1');  # flag: success
    }

    public function get(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $device->alive();
        $device_datas = $device->toArray();
        unset($device_datas['id'], $device_datas['user_id'], $device_datas['imei'], $device_datas['alive_at']);
        unset($device_datas['door_status_updated'], $device_datas['alarm_status_updated']);
        unset(
            $device_datas['terminal1_title'],
            $device_datas['terminal2_title'],
            $device_datas['terminal3_title'],
            $device_datas['terminal4_title'],
            $device_datas['terminal5_title'],
            $device_datas['terminal6_title'],
            $device_datas['terminal7_title'],
            $device_datas['terminal8_title'],
        );
        $device_datas['created_at'] = strtotime($device_datas['created_at']) ?: 0;
        $device_datas['updated_at'] = strtotime($device_datas['updated_at']) ?: 0;
        $device_query = implode('|', array_values($device_datas));
        $have_actions = (count($device->accounts) > 0);
        $actions_query = $have_actions ? "1" : "0";
        $result = "1|"  # flag: success
                . $actions_query . "|"  # flag: accounts action
                . $device_query;
        return $this->encode($result);
    }

    public function user(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: no action
        }
        $account = Account::where('device_id', $device->id)->where('action', '!=', 0)->first();
        if(!$account){
            return $this->encode('0');  # flag: no action
        }
        $account_datas = $account->toArray();
        unset($account_datas['id'], $account_datas['device_id']);
        unset($account_datas['action'], $account_datas['created_at'], $account_datas['server_side']);
        $account_datas['start_at'] = strtotime($account_datas['start_at'] ?? date('c'));
        $account_datas['end_at'] = strtotime($account_datas['end_at'] ?? date('c'));
        $account_datas['updated_at'] = strtotime($account_datas['updated_at'] ?? date('c'));
        $account_query = implode('|', array_values($account_datas));
        $action = $account->action == Account::REPORT_NEW ? 0 : 1;
        $result = "1|"  # flag: action exists
                . $action . "|"  # flag: action enum
                . $account_query;  # flag: account query
        return $this->encode($result);
    }

    public function updateuser(Request $request, string $imei){
        $query = $request->input('query', '');
        $query = $this->decode($query);
        if(!$query){
            return $this->encode('0');  # flag: unsuccess
        }
        $query = explode('|', $request->input('query'));
        if(count($query) != 5){
            return $this->encode('0');  # flag: unsuccess
        }
        $server_side = true;
        $account = Account::where('username', $query[1])->first();
        if($account->device->imei != $imei){
            return $this->encode('0');  # flag: unsuccess
        }
        if($server_side){
            if(!$account || $account->action == Account::REPORTED || ($account->action == Account::REPORT_NEW ? 0 : 1) != intval($query[0]) || $account->password != $query[2]){
                return $this->encode('0');  # flag: unsuccess
            }
            if($account->action == Account::REPORT_NEW){
                $account->update([
                    "action" => Account::REPORTED,
                ]);
            }elseif($account->action == Account::REPORT_REMOVED){
                $account->delete();
            }
            return $this->encode('1');  # flag: success
        }
        return $this->encode('0');  # flag: unsuccess
    }

    public function log(Request $request, string $imei){
        $query = $request->input('query', '');
        $query = $this->decode($query);
        if(!$query){
            return $this->encode('0');  # flag: unsuccess
        }
        $query = explode('|', $query);
        if(count($query) != 4){
            return $this->encode('0');  # flag: unsuccess
        }
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $value = $query[2];
        if($value == '0' || $value == '1'){
            $value = ($value != '0') ? "فعال" : "غیرفعال";
        }
        // $log = Log::orderBy('id', 'desc')->where('device_id', $device->id)->where('username', $query[0])->where('server_side', false)->first();
        // if($log && $log->field == $query[1]){
        //     $log->update([
        //         "value" => $value,
        //         "alerted" => $log->value == $value && $log->alerted,
        //     ]);
        // }else{
            Log::create([
                "device_id" => $device->id,
                "organization_id" => $device->user->organization_id,
                "username" => $query[0],
                "field" => $query[1],
                "value" => $value,
                "server_side" => false,
                "updated_at" => date("Y-m-d H:i:s", intval($query[2])),
            ]);
        // }
        return $this->encode('1');  # flag: success
    }

    public function alive(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $device->alive();
        return $this->encode('1');  # flag: success
    }

    public function doorStatusUpdated(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $device->update([
            "door_status_updated" => false,
        ]);
        return $this->encode('1');  # flag: success
    }

    public function alarmStatusUpdated(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return $this->encode('0');  # flag: unsuccess
        }
        $device->update([
            "alarm_status_updated" => false,
        ]);
        return $this->encode('1');  # flag: success
    }
}
