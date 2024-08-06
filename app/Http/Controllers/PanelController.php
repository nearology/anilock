<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function panel(Request $request){
        $user = Auth::user();
        $users = User::all();
        $devices = Device::all();
        $organizations = Organization::all();
        return view("panel", [
            "user" => $user,
            "users" => $users,
            "devices" => $devices,
            "organizations" => $organizations,
        ]);
    }

    public function addUserPage(Request $request){
        $user = Auth::user();
        $organizations = Organization::all();
        return view("panel.new-user", [
            "user" => $user,
            "organizations" => $organizations,
        ]);
    }
    public function addUser(Request $request){
        $request->validate([
            "organization" => "required",
            "username" => "required",
            "password" => "required",
        ]);
        $organization = Organization::where('keyname', $request->organization)->first();
        if(!$organization){
            return redirect()->back()
                ->withInput($request->only('username', 'organization', 'user_access', 'admin'))
                ->withErrors([
                    'organizaton' => 'سازمانی با این کلید وجود ندارد.',
                ]);
        }
        $user = User::where('username', $request->username)->first();
        if($user){
            return redirect()->back()
                ->withInput($request->only(['username', 'organizaiton', 'user_access', 'admin']))
                ->withErrors([
                    'device' => 'از قبل کاربری در پنل با این یوزرنیم ثبت شده است.',
                ]);
        }
        User::create([
            'organization_id' => $organization->id,
            'username' => $request->username,
            'password' => $request->password,
            'admin' => $request->has('admin'),
            'user_access' => $request->has('user_access'),
        ]);
        return redirect()->route('panel');
    }
    public function removeUser(Request $request, int $user_id){
        $user = User::find($user_id);
        if($user){
            $user->delete();
        }
        return redirect()->route('panel');
    }

    public function addOrganizationPage(Request $request){
        $user = Auth::user();
        return view("panel.new-organization", [
            "user" => $user,
        ]);
    }
    public function addOrganization(Request $request){
        $request->validate([
            "title" => "required",
            "keyname" => "required",
        ]);
        $organization = Organization::where('keyname', $request->keyname)->first();
        if($organization){
            return redirect()->back()
                ->withInput($request->only(['title']))
                ->withErrors([
                    'device' => 'سازمانی از قبل با این کلید ثبت شده است.',
                ]);
        }
        Organization::create($request->only("title", "keyname"));
        return redirect()->route('panel');
    }
    public function removeOrganization(Request $request, int $organization_id){
        $organization = Organization::find($organization_id);
        if(!$organization){
            return redirect()->route('panel');
        }
        $organization->users()->delete();
        $organization->delete();
        return redirect()->route('panel');
    }
}
