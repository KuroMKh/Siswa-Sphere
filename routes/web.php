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


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:admin'])->get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'role:admin'])->get('/manage_member/add-mem-dashboard', [AdminController::class, 'create'])->name('add-mem-dashboard');
Route::middleware(['auth', 'role:admin'])->get('/manage_member/list-all-mem-dashboard', [AdminController::class, 'list'])->name('list-all-mem-dashboard');
Route::middleware(['auth', 'role:admin'])->get('/manage_member/all-mem-profile-detail/{matrix_no}', [AllMemberInformationController::class, 'viewallmember'])->name('all-mem-profile-detail');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/manage_member/all-mem-profile-detail/{matrix_no}', [UpdateMemberPositionController::class, 'update'])->middleware(['auth', 'role:admin'])->name('Update-all-mem-profile-detail');
// Member-only dashboard
Route::middleware(['auth', 'role:member'])->get('/member/mem-dashboard', [MemberController::class, 'index'])->name('member.mem-dashboard');
Route::middleware(['auth', 'role:member'])->get('/member/mem-meetingdetail/{id}', [MeetingController::class, 'show'])->name('member.mem-meetingdetail');
Route::middleware(['auth', 'role:member'])->get('/member/mem-profile', [MemberController::class, 'viewmemprofile'])->name('member.mem-profile');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
