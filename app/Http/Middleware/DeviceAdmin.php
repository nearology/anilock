<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $imei = $request->route('imei');
        if($user && $imei){
            $device = Device::where('imei', $imei)->first();
            if($device && $device->user_id == $user->id){
                return $next($request);
            }
        }
        return redirect()->route('home');
    }
}
