<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllMemberInformationController;
use App\Http\Controllers\UpdateMemberPositionController;
use App\Http\Controllers\updateattendance;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Route (Generic)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Meeting Management
    Route::get('/manage_meeting/create_meeting', [AdminController::class, 'newmeeting'])->name('create_meeting');
    Route::get('/admin/admin.meetingdetail/{id}', [MeetingController::class, 'showadmin'])->name('admin.meetingdetail');
    Route::post('/manage_meeting/admin_meetingdetail/{id}', [MeetingController::class, 'updateStatus'])->name('admin_meetingdetail');

    // Member Management
    Route::get('/manage_member/list-all-mem-dashboard', [AdminController::class, 'list'])->name('list-all-mem-dashboard');
    Route::get('/manage_member/all-mem-profile-detail/{matrix_no}', [AllMemberInformationController::class, 'viewallmember'])->name('all-mem-profile-detail');
    Route::post('/manage_member/all-mem-profile-detail/{matrix_no}', [UpdateMemberPositionController::class, 'update'])->name('Update-all-mem-profile-detail');
});

// Member Routes
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/member/mem-dashboard', [MemberController::class, 'index'])->name('member.mem-dashboard');
    Route::get('/member/mem-meetingdetail/{id}', [MeetingController::class, 'show'])->name('member.mem-meetingdetail');
    Route::get('/member/mem-profile', [MemberController::class, 'viewmemprofile'])->name('member.mem-profile');
    Route::get('/member/mem-meeting-documentation', [MemberController::class, 'viewmeetingdocumentation'])->name('member.mem-meeting-documentation');
});

// Meeting Routes (Shared)
Route::middleware(['auth'])->group(function () {
    Route::post('/createmeetings', [MeetingController::class, 'createmeeting'])->name('createmeeting');
    Route::post('/admin/meeting/{id}/attendance', [updateattendance::class, 'storeAttendance'])->name('member_attendance');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Settings Routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';