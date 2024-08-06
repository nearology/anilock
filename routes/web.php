<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\DeviceAdmin;
use App\Http\Middleware\OrganizationAdmin;
use App\Http\Middleware\SiteAdmin;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'mainPage']);
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/signout', [UserController::class, 'signout'])->name('signout');
    Route::get('/device/add', [UserController::class, 'addDevicePage'])->name('device.add');
    Route::post('/device/add', [UserController::class, 'addDevice']);

    Route::get('/devices', [UserController::class, 'devices'])->name('devices');
    Route::get('/deviceUpdate', [UserController::class, 'deviceUpdate'])->name('deviceUpdate');
    Route::get('/deviceUsers', [UserController::class, 'deviceUsers'])->name('deviceUsers');
    Route::get('/deviceUser/new', [UserController::class, 'newDeviceUserPage'])->name('newDeviceUser');
    Route::post('/deviceUser/new', [UserController::class, 'newDeviceUser'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/updateDevice', [UserController::class, 'updateDevice'])->withoutMiddleware(VerifyCsrfToken::class);

    Route::get('/notifs', [UserController::class, 'notifs'])->name('notifs');

    Route::get('/logs', [UserController::class, 'logs'])->name('logs');
    Route::get('/alerts', [UserController::class, 'alerts'])->name('alerts');
    Route::get('/about', [UserController::class, 'about'])->name('about');

    Route::get('/profile', [UserController::class, 'profilePage'])->name('profile');
    Route::post('/profile', [UserController::class, 'profile']);
    Route::post('/password', [UserController::class, 'password']);

    Route::post('/doorStatusUpdated/{imei}', [UserController::class, "doorStatusUpdated"])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/alarmStatusUpdated/{imei}', [UserController::class, "alarmStatusUpdated"])->withoutMiddleware(VerifyCsrfToken::class);
});

Route::group([
    'prefix' => '/device/{imei}',
    'middleware' => DeviceAdmin::class,
], function(){
    Route::get('/users', [UserController::class, 'users'])->name('device.users');
    Route::get('/user/new', [UserController::class, 'newUserPage'])->name('device.user.new');
    Route::post('/user/new', [UserController::class, 'newUser']);
    Route::get('/user/{user}/remove', [UserController::class, 'removeUser'])->name('device.user.remove');

    Route::get('/remove', [UserController::class, 'removeDevice'])->name('device.remove');
});

Route::middleware([OrganizationAdmin::class])->group(function(){
    Route::get('/organization', [OrganizationController::class, 'organization'])->name('organization');

    Route::get('/organization/new', [OrganizationController::class, 'addMemberPage'])->name('organization.new');
    Route::post('/organization/new', [OrganizationController::class, 'addMember']);
    Route::get('/organization/{user}/remove', [OrganizationController::class, 'removeMember']);
});

Route::middleware([SiteAdmin::class])->group(function(){
    Route::get('/panel', [PanelController::class, 'panel'])->name('panel');

    Route::get('/panel/organization', [PanelController::class, 'addOrganizationPage'])->name('panel.organization');
    Route::post('/panel/organization', [PanelController::class, 'addOrganization']);
    Route::get('/panel/{organization}/removeOrganization', [PanelController::class, 'removeOrganization']);
    Route::get('/panel/new', [PanelController::class, 'addUserPage'])->name('panel.new');
    Route::post('/panel/new', [PanelController::class, 'addUser']);
    Route::get('/panel/{user}/remove', [PanelController::class, 'removeUser']);
});
