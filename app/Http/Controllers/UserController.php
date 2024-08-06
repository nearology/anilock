<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Device;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    public function home(Request $requeset){
        /** @var User */
        $user = Auth::user();
        $device_count = $user->devices()->count();
        $users_count = $user->organization->users->count();
        return view("home", [
            "user" => $user,
            "users_count" => $users_count,
            "device_count" => $device_count,
        ]);
    }
    public function deviceUpdate(Request $requeset){
        /** @var User */
        $user = Auth::user();
        return response(json_encode($user->devices), headers: ["Content-Type" => "application/json"]);
    }

    public function notifs(Request $request){
        /** @var Log[] */
        $notifs = Log::orderBy('id', 'desc')->with('device')->where('server_side', false)->where('alerted', false)->limit(5)->get();
        foreach($notifs as $notif){
            $notif->field_name = $notif->fieldName();
        }
        Log::where('alerted', false)->update(['alerted' => true]);
        return response(json_encode($notifs), headers: ["Content-Type" => "application/json"]);
    }

    public function devices(Request $request){
        /** @var User */
        $user = Auth::user();
        return view("devices", [
            "user" => $user,
        ]);
    }
    public function deviceUsers(Request $request){
        $user = Auth::user();
        $all_accounts = Account::all();
        $accounts = [];
        foreach($all_accounts as $account){
            if($account->device->user_id == $user->id){
                $accounts[] = $account;
            }
        }
        return view("device-users", [
            "user" => $user,
            "accounts" => $accounts,
        ]);
    }

    public function updateDevice(Request $request){
        $request->validate([
            "imei" => "required",
            "field" => "required",
        ]);
        /** @var User */
        $user = Auth::user();
        $device = Device::where('imei', $request->imei)->first();
        if(!$device){
            return "fail";
        }
        if($device->user_id != $user->id){
            return "fail";
        }
        $field = $request->field;
        $value = $request->value ?? null;
        if($value == '0' || $value == '1'){
            $value = intval($value);
        }
        if(\str_starts_with($field, "relay_module_terminal")){
            $index = intval(substr($field, 21)) - 1;
            $device->relay_module_terminal = ($device->relay_module_terminal & ~(1 << $index)) | ($value << $index);
        }else{
            $device->$field = $value;
        }
        if($field == "door_status"){
            $device->door_status_updated = true;
        }
        if($field == "alarm_status"){
            $device->alarm_status_updated = true;
        }
        $device->save();
        if($value == '0'){
            $value = "غیرفعال";
        }
        if($value == '1'){
            $value = "فعال";
        }
        if($value === null){
            $value = "حذف";
        }
        Log::create([
            "device_id" => $device->id,
            "organization_id" => $user->organization_id,
            "username" => $user->username,
            "field" => $request->field,
            "value" => $value,
            "server_side" => true,
        ]);
        return "ok";
    }

    public function convertNumbers($string) {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $string = str_replace($persianNumbers, $englishNumbers, $string);
        $string = str_replace($arabicNumbers, $englishNumbers, $string);

        return $string;
    }

    public function users(Request $request, string $imei){
        $user = Auth::user();
        $device = Device::where('imei', $imei)->first();
        $device->hasAlive();
        return view('device.users', [
            'user' => $user,
            'device' => $device,
        ]);
    }
    public function newUserPage(Request $request, string $imei){
        $user = Auth::user();
        $device = Device::where('imei', $imei)->first();
        return view('device.new-user', [
            'user' => $user,
            'device' => $device,
        ]);
    }
    public function newUser(Request $request, string $imei){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $device = Device::where('imei', $imei)->first();
        if(!$device){
            return redirect()->route('home');
        }
        $account = Account::where('device_id', $device->id)->where('username', $request->username)->where('action', Account::REPORTED)->first();
        if($account){
            return redirect()->back()
                ->withInput($request->only(['username', 'start_at', 'end_at']))
                ->withErrors([
                    'device' => 'کاربری با این یوزرنیم از قبل در این دستگاه وجود دارد.',
                ]);
        }
        $start_at = $request->start_at ? date('Y-m-d H:i:s', Jalalian::fromFormat('Y/m/d H:i:s', $this->convertNumbers($request->start_at))->getTimestamp()) : null;
        $end_at = $request->end_at ? date('Y-m-d H:i:s', Jalalian::fromFormat('Y/m/d H:i:s', $this->convertNumbers($request->end_at))->getTimestamp()) : null;
        Account::create([
            'device_id' => $device->id,
            'action' => Account::REPORT_NEW,
            'username' => $request->username,
            'password' => $request->password,
            'start_at' => $start_at,
            'end_at' => $end_at,
        ]);
        return redirect()->route('device.users', [
            'imei' => $device->imei,
        ]);
    }
    public function removeUser(Request $request, string $imei, int $user_id){
        $user = Auth::user();
        $device = Device::where('imei', $imei)->first();
        $account = Account::find($user_id);
        if(!$account || $account->device_id != $device->id){
            return redirect()->route('home');
        }
        if($account->action == Account::REPORTED){
            $account->update([
                'action' => Account::REPORT_REMOVED,
            ]);
        }elseif($account->action == Account::REPORT_NEW){
            $account->delete();
        }
        Log::create([
            "device_id" => $device->id,
            "organization_id" => $user->organization_id,
            "username" => $user->username,
            "field" => "حذف کاربر",
            "value" => "یوزرنیم {$account->username}",
            "server_side" => true,
        ]);
        return redirect()->route('deviceUsers');
    }

    public function newDeviceUserPage(Request $request){
        $user = Auth::user();
        $devices = Device::where('user_id', $user->id)->get();
        return view('new-deviceuser', [
            'user' => $user,
            'devices' => $devices,
        ]);
    }
    public function newDeviceUser(Request $request){
        $request->validate([
            'device' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = Auth::user();
        $device_ids = $request->device;
        $devices = [];
        foreach($device_ids as $device_id){
            $device = Device::find($device_id);
            if($device && $device->user_id == $user->id){
                $devices[] = $device;
            }
        }
        if(!$devices){
            return redirect()->back()
                ->withInput($request->only(['device', 'username']))
                ->withErrors([
                    'device' => 'دستگاه وارد شده یافت نشد.',
                ]);
        }
        foreach($devices as $device){
            $account = Account::where('device_id', $device->id)->where('username', $request->username)->where('action', Account::REPORTED)->first();
            if($account){
                return redirect()->back()
                    ->withInput($request->only(['device', 'username', 'start_at', 'end_at']))
                    ->withErrors([
                        'device' => "کاربری با این یوزرنیم در دستگاه {$device->name} از قبل وجود دارد.",
                    ]);
            }
        }
        $start_at = $request->start_at ? date('Y-m-d H:i:s', Jalalian::fromFormat('Y/m/d H:i:s', $this->convertNumbers($request->start_at))->getTimestamp()) : null;
        $end_at = $request->end_at ? date('Y-m-d H:i:s', Jalalian::fromFormat('Y/m/d H:i:s', $this->convertNumbers($request->end_at))->getTimestamp()) : null;
        foreach($devices as $device){
            Account::create([
                'device_id' => $device->id,
                'action' => Account::REPORT_NEW,
                'username' => $request->username,
                'password' => $request->password,
                'start_at' => $start_at,
                'end_at' => $end_at,
            ]);
            Log::create([
                "device_id" => $device->id,
                "organization_id" => $user->organization_id,
                "username" => $user->username,
                "field" => "افزودن کاربر",
                "value" => "یوزرنیم {$request->username}",
                "server_side" => true,
            ]);
        }
        return redirect()->route('deviceUsers');
    }

    public function signout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function addDevicePage(Request $request){
        $user = Auth::user();
        return view('add-device', [
            'user' => $user,
        ]);
    }
    public function addDevice(Request $request){
        $request->validate([
            'imei' => 'required',
        ]);
        $user = Auth::user();
        $device = Device::where('imei', $request->imei)->first();
        if($device){
            if($device->user_id){
                return redirect()->back()
                    ->withInput($request->only(['imei']))
                    ->withErrors([
                        'imei' => 'دستگاهی با این imei از قبل ثبت شده است.',
                    ]);
            }else{
                $device->update([
                    'user_id' => $user->id,
                ]);
            }
        }else{
            $device = Device::create([
                'user_id' => $user->id,
                'status' => 0,
                'name' => '-',
                'ssid' => 0,
                'password' => '',
                'imei' => $request->imei,
                'ups_status' => false,
                'door_status' => false,
                'relay_module' => false,
                'relay_module_terminal' => 0,
                'lock_status1' => false,
                'lock_status2' => false,
                'bat_status' => false,
                'rssi' => 0,
                'alarm_status' => false,
            ]);
        }
        Log::create([
            "device_id" => $device->id,
            "organization_id" => $user->organization_id,
            "username" => $user->username,
            "field" => "افزودن دستگاه",
            "value" => "-",
            "server_side" => true,
        ]);
        return redirect()->route('devices');
    }

    public function logs(Request $request){
        $user = Auth::user();
        $logs = Log::orderBy('id', 'desc')->where('organization_id', $user->organization_id)->where('server_side', true)->get();
        return view('logs', [
            "user" => $user,
            "logs" => $logs,
        ]);
    }
    public function alerts(Request $request){
        $user = Auth::user();
        $logs = Log::orderBy('id', 'desc')->where('organization_id', $user->organization_id)->where('server_side', false)->get();
        return view('alerts', [
            "user" => $user,
            "logs" => $logs,
        ]);
    }
    public function about(Request $request){
        $user = Auth::user();
        return view('about', [
            "user" => $user,
        ]);
    }

    public function profilePage(Request $request){
        $user = Auth::user();
        return view('profile', [
            "user" => $user,
        ]);
    }
    public function profile(Request $request){
        $request->validate([
            'username' => 'required',
        ]);
        /** @var User */
        $user = Auth::user();
        if($user->username != $request->username){
            $search = User::where('username', $request->username)->first();
            if($search){
                return redirect()->back()
                    ->withInput($request->only(['organization_name', 'username']))
                    ->withErrors([
                        'device' => 'کاربری از قبل با این یوزرنیم وجود دارد.',
                    ]);
            }
            $user->update([
                'username' => $request->username,
            ]);
        }
        if($user->user_access && $request->organization_name && $user->organization->title != $request->organization_name){
            $user->organization->update([
                'title' => $request->organization_name,
            ]);
        }
        return redirect()->route('profile');
    }

    public function password(Request $request){
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',
        ]);
        /** @var User */
        $user = Auth::user();
        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()
                ->withErrors([
                    'device' => 'رمز وارد شده فعلی درست نمیباشد.',
                ]);
        }
        $user->update([
            "password" => Hash::make($user->password),
        ]);
        return redirect()->route('home');
    }


    public function doorStatusUpdated(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        return $device && $device->door_status_updated ? '1' : '0';
    }

    public function alarmStatusUpdated(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        return $device && $device->alarm_status_updated ? '1' : '0';
    }

    public function removeDevice(Request $request, string $imei){
        $device = Device::where('imei', $imei)->first();
        $device->delete();
        $user = Auth::user();
        Log::create([
            "device_id" => $device->id,
            "organization_id" => $user->organization_id,
            "username" => $user->username,
            "field" => "حذف دستگاه",
            "value" => "-",
            "server_side" => true,
        ]);
        return redirect()->route('home');
    }
}
