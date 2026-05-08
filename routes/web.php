<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\PaketMemberController;
use App\Http\Controllers\Admin\PaketHarianController;
use App\Http\Controllers\Admin\KunjunganHarianController;
use App\Http\Controllers\Admin\KunjunganMemberController;
use App\Http\Controllers\Admin\JadwalLatihanController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaporanController;

// ─── Redirect root ───────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─── Auth ────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ─── Owner Only ──────────────────────────────────────────
Route::middleware(['auth', 'role:owner'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('admin', AdminController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['admin' => 'admin']);
    });
// ─── Admin & Owner ───────────────────────────────────────
Route::middleware(['auth', 'role:owner,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Paket Member
        Route::resource('paket-member', PaketMemberController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['paket-member' => 'paketMember']);

        // Paket Harian
        Route::resource('paket-harian', PaketHarianController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->parameters(['paket-harian' => 'paketHarian']);

        // Kunjungan Harian
        Route::resource('kunjungan-harian', KunjunganHarianController::class)
        ->only(['index', 'store', 'destroy'])
        ->parameters(['kunjungan-harian' => 'kunjunganHarian']);

        // Kunjungan Member
        Route::resource('kunjungan-member', KunjunganMemberController::class)
        ->only(['index', 'store', 'destroy'])
        ->parameters(['kunjungan-member' => 'kunjunganMember']);

        // Jadwal Latihan
        Route::resource('jadwal-latihan', JadwalLatihanController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['jadwal-latihan' => 'jadwalLatihan']);

        // Gerakan Latihan (nested)
        Route::get('jadwal-latihan/{jadwalLatihan}/detail', [JadwalLatihanController::class, 'detail'])
            ->name('jadwal-latihan.detail');
        Route::post('jadwal-latihan/{jadwalLatihan}/gerakan', [JadwalLatihanController::class, 'storeGerakan'])
            ->name('jadwal-latihan.gerakan.store');
        Route::post('gerakan/{gerakanLatihan}/update', [JadwalLatihanController::class, 'updateGerakan'])
            ->name('jadwal-latihan.gerakan.update');
        Route::delete('gerakan/{gerakanLatihan}', [JadwalLatihanController::class, 'destroyGerakan'])
            ->name('jadwal-latihan.gerakan.destroy');

        // Member
        Route::resource('member', MemberController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['member' => 'member']);

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
                
    });

// ─── User ────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    });


// dashboard pages
Route::get('/papan', function () {
    return view('pages.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']);
})->name('dashboard');

// calender pages
Route::get('/calendar', function () {
    return view('pages.calender', ['title' => 'Calendar']);
})->name('calendar');

// profile pages
Route::get('/profile', function () {
    return view('pages.profile', ['title' => 'Profile']);
})->name('profile');

// form pages
Route::get('/form-elements', function () {
    return view('pages.form.form-elements', ['title' => 'Form Elements']);
})->name('form-elements');

// tables pages
Route::get('/basic-tables', function () {
    return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
})->name('basic-tables');

// pages

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');

// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

// chart pages
Route::get('/line-chart', function () {
    return view('pages.chart.line-chart', ['title' => 'Line Chart']);
})->name('line-chart');

Route::get('/bar-chart', function () {
    return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
})->name('bar-chart');


// authentication pages
Route::get('/signin', function () {
    return view('pages.auth.signin', ['title' => 'Sign In']);
})->name('signin');

Route::get('/signup', function () {
    return view('pages.auth.signup', ['title' => 'Sign Up']);
})->name('signup');

// ui elements pages
Route::get('/alerts', function () {
    return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
})->name('alerts');

Route::get('/avatars', function () {
    return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
})->name('avatars');

Route::get('/badge', function () {
    return view('pages.ui-elements.badges', ['title' => 'Badges']);
})->name('badges');

Route::get('/buttons', function () {
    return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
})->name('buttons');

Route::get('/image', function () {
    return view('pages.ui-elements.images', ['title' => 'Images']);
})->name('images');

Route::get('/videos', function () {
    return view('pages.ui-elements.videos', ['title' => 'Videos']);
})->name('videos');