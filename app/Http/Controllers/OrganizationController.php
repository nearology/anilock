<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function organization(Request $request){
        $user = Auth::user();
        return view("organization", [
            "user" => $user,
        ]);
    }

    public function addMemberPage(Request $request){
        $user = Auth::user();
        return view("organization.new-user", [
            "user" => $user,
        ]);
    }
    public function addMember(Request $request){
        $request->validate([
            "username" => "required",
            "password" => "required",
        ]);
        $search = User::where('username', $request->username)->first();
        if($search){
            return redirect()->back()
                ->withInput($request->only(['username']))
                ->withErrors([
                    'device' => 'از قبل کاربری در پنل با این یوزرنیم ثبت شده است.',
                ]);
        }
        $user = Auth::user();
        User::create([
            "organization_id" => $user->organization_id,
            "username" => $request->username,
            "password" => $request->password,
            "user_access" => $request->has("user_access"),
        ]);
        return redirect()->route('organization');
    }
    public function removeMember(Request $request, int $user_id){
        $user = Auth::user();
        $member = User::find($user_id);
        if($member && $user->organization->id == $member->organization->id){
            $member->delete();
        }
        return redirect()->route('organization');
    }
}
