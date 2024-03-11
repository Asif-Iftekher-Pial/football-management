<?php

use App\Http\Controllers\AdminApproveCOntroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FootballClubController;
use App\Http\Controllers\FootballGroupPartnerController;
use App\Http\Controllers\FootballGroupStaffController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OtherFootballJobsController;
use App\Http\Controllers\PickUserController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StripePaymentController;
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
Route::get('/job-registration/login', [AuthController::class, 'job_registration'])->name('job.login');
Route::post('/job-registration/login-submit', [AuthController::class, 'job_registration_submit'])->name('job.login.submit');
Route::get('/manager-registration/login', [AuthController::class, 'manager_registration'])->name('manager.login');
Route::post('/manager-registration/login-submit', [AuthController::class, 'manager_registration_submit'])->name('manager.login.submit');
Route::get('/partner-registration/login', [AuthController::class, 'partner_registration'])->name('partner.login');
Route::post('/partner-registration/login', [AuthController::class, 'partner_registration_submit'])->name('partner.login.submit');
Route::get('/player-registration/login', [AuthController::class, 'player_registration'])->name('player.login');
Route::post('/player-registration/login-submit', [AuthController::class, 'player_registration_submit'])->name('player.login.submit');
Route::get('/staff-registration/login', [AuthController::class, 'staff_registration'])->name('staff.login');
Route::post('/staff-registration/login-submit', [AuthController::class, 'staff_registration_submit'])->name('staff.login.submit');

Route::get('/club-registration/login', [AuthController::class, 'club_registration'])->name('club.login');
Route::post('/club-registration/login-submit', [AuthController::class, 'club_registration_submit'])->name('club.login.submit');

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

        //Football Club
        Route::resource('football-club', FootballClubController::class);
        Route::get('football-club-approve/{id}/{status}', [FootballClubController::class, 'adminApproveStatusOfFootballClub'])->name('football_club.approve.status');
        Route::get('football-club-payment-approve/{id}/{status}', [FootballClubController::class, 'adminApprovePaymentStatusOfFootballClub'])->name('football_club.payment.status');
        Route::get('football-club-pdf/{id}', [FootballClubController::class, 'exportToPdf'])->name('football_club.export.pdf');

        //Pick Player By Club
        Route::get('players-list',[PickUserController::class,'playerList'])->name('player.list');
        Route::get('player-detail/{id}',[PickUserController::class,'show'])->name('player.detail');
        Route::get('player-detail-pdf/{id}', [PickUserController::class, 'exportToPdf'])->name('player.detail.export.pdf');

        //Pick Manager by Club
        Route::get('manager-list',[PickUserController::class,'managerList'])->name('manager.list');
        Route::get('manager-detail/{id}',[PickUserController::class,'manager_show'])->name('manager.detail');
        Route::get('manager-detail-pdf/{id}', [PickUserController::class, 'manager_exportToPdf'])->name('manager.detail.export.pdf');

        //select player by club
        Route::get('select-player/{id}',[PickUserController::class,'player_pick'])->name('player.pick');
        //manager pick
        Route::get('select-manager/{id}',[PickUserController::class,'manager_pick'])->name('manager.pick');
        
        
        // Retrive all players with all clubs
        Route::get('all-players-for-see-clubs',[PickUserController::class,'selectedPlayerListByClubs'])->name('all.players.with.clubs');
        Route::get('all-clubs-of-player/{id}',[PickUserController::class,'selectedPlayerByClubs'])->name('view.selected.clubs');
        Route::get('remove-club-from-player/{player_id}/{club_id}',[PickUserController::class,'removeCLubFromPlayer'])->name('remove.selected.club');

        Route::get('all-manager-for-see-clubs',[PickUserController::class,'selectedManagerListByClubs'])->name('all.managers.with.clubs');
        Route::get('all-clubs-of-manager/{id}',[PickUserController::class,'selectedManagerByClubs'])->name('view.selected.manager.by.clubs');
        Route::get('remove-club-from-manager/{manager_id}/{club_id}',[PickUserController::class,'removeCLubFromManager'])->name('remove.selected.club.form.manager');



        // //STripe payment
        // Route::get('stripe',[StripePaymentController::class,'stripe'])->name('stripe');
        // Route::get('stripe-checkout',[StripePaymentController::class,'stripeCheckout'])->name('stripe.checkout');
        // Route::get('stripe-checkout/success',[StripePaymentController::class,'stripeCheckoutSuccess'])->name('stripe.checkout.success');



        //Stripe Payment
        Route::get('stripe',[StripePaymentController::class,'getStripe'])->name('stripe.page');
        Route::post('stripe',[StripePaymentController::class,'postStripe'])->name('stripe.submit');
        Route::get('stripe/success',[StripePaymentController::class,'successTransaction'])->name('stripe.success');
        Route::get('stripe/cancel',[StripePaymentController::class,'cancelTransaction'])->name('stripe.cancel');

        Route::get('send-paypal-payment-link/{id}',[FootballClubController::class,'sendPaypalPaymentLink'])->name('sendPaypalPaymentLink');
    });

   
});
