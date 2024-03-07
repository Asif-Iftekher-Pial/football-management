<?php

use App\Http\Controllers\AdminApproveCOntroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FootballGroupPartnerController;
use App\Http\Controllers\FootballGroupStaffController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OtherFootballJobsController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('submit-login', [AuthController::class, 'store'])->name('submit.login');

Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {

    //block message route 

    Route::get('block-page',[AdminApproveCOntroller::class,'blockMessage'])->name('blockMessage');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Roles and Permissions
    Route::resource('roles-permissions', RolePermissionController::class);
    Route::get('assign-permissions-to-role-page/{role_id}', [RolePermissionController::class, 'assignPermissionToRolePage'])->name('assignPermissionToRolePage');
    Route::post('assign-permissions-to-role/{role_id}', [RolePermissionController::class, 'assignPermissionToRole'])->name('assignPermissionToRole');
    Route::get('assign-role-to-user/{user_id}', [RolePermissionController::class, 'assignRoleToUser'])->name('assignRoleToUser');
    Route::post('assign-roles-to-user/{user_id}', [RolePermissionController::class, 'assignRolesToUser'])->name('assignRolesToUser');
    
    
    //Status approved routes
    Route::group(['middleware' => 'status_approve_by_admin'], function () {
        //Football group staff
        Route::resource('football-group-staff', FootballGroupStaffController::class);
        Route::get('admin-approve-status/{id}/{status}', [FootballGroupStaffController::class, 'adminApproveStatus'])->name('admin.approve.status');
        Route::get('football-group-pdf/{id}', [FootballGroupStaffController::class, 'exportToPdf'])->name('footballGroup.export.pdf');

        //Football group partner
        Route::resource('group-partner', FootballGroupPartnerController::class);
        Route::get('admin-approve-status-partner/{id}/{status}', [FootballGroupPartnerController::class, 'adminApproveStatus'])->name('admin.approve.status.partner');
        Route::get('football-group-partner-pdf/{id}', [FootballGroupPartnerController::class, 'exportToPdf'])->name('footballGroupPartner.export.pdf');

        //Player
        Route::resource('player', PlayerController::class);
        Route::get('admin-approve-player/{id}/{status}', [PlayerController::class, 'adminApproveStatus'])->name('admin.approve.player');
        Route::get('player-pdf/{id}', [PlayerController::class, 'exportToPdf'])->name('player.export.pdf');

        //Manager
        Route::resource('manager', ManagerController::class);
        Route::get('manager-approve/{id}/{status}', [ManagerController::class, 'adminApproveStatusOfManager'])->name('manager.approve.status');
        Route::get('manager-pdf/{id}', [ManagerController::class, 'exportToPdf'])->name('manager.export.pdf');

        //Other Football Job
        Route::resource('other-football-job', OtherFootballJobsController::class);
        Route::get('other-football-job-approve/{id}/{status}', [OtherFootballJobsController::class, 'adminApproveStatusOfOtherFootballJob'])->name('football_job.approve.status');
        Route::get('other-football-job-pdf/{id}', [OtherFootballJobsController::class, 'exportToPdf'])->name('football_job.export.pdf');


    });

   
});
