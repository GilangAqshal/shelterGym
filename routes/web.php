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
use App\Http\Controllers\ProfileController;

// ─── Redirect root ───────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─── Auth ────────────────────────────────────────────────
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ─── Profile (semua role) ────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ─── Admin & Owner ───────────────────────────────────────
Route::middleware(['auth', 'role:owner,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::resource('paket-member', PaketMemberController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['paket-member' => 'paketMember']);
        Route::resource('paket-harian', PaketHarianController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['paket-harian' => 'paketHarian']);
        Route::resource('kunjungan-harian', KunjunganHarianController::class)
            ->only(['index', 'store', 'destroy'])
            ->parameters(['kunjungan-harian' => 'kunjunganHarian']);
        Route::resource('kunjungan-member', KunjunganMemberController::class)
            ->only(['index', 'store', 'destroy'])
            ->parameters(['kunjungan-member' => 'kunjunganMember']);
        Route::resource('jadwal-latihan', JadwalLatihanController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['jadwal-latihan' => 'jadwalLatihan']);
        Route::get('jadwal-latihan/{jadwalLatihan}/detail', [JadwalLatihanController::class, 'detail'])
            ->name('jadwal-latihan.detail');
        Route::post('jadwal-latihan/{jadwalLatihan}/gerakan', [JadwalLatihanController::class, 'storeGerakan'])
            ->name('jadwal-latihan.gerakan.store');
        Route::post('gerakan/{gerakanLatihan}/update', [JadwalLatihanController::class, 'updateGerakan'])
            ->name('jadwal-latihan.gerakan.update');
        Route::delete('gerakan/{gerakanLatihan}', [JadwalLatihanController::class, 'destroyGerakan'])
            ->name('jadwal-latihan.gerakan.destroy');
        Route::resource('member', MemberController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['member' => 'member']);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
        Route::get('laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');
    });

// ─── Owner Only ──────────────────────────────────────────
Route::middleware(['auth', 'role:owner'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('admin', AdminController::class)
            ->only(['index', 'store', 'update', 'destroy'])
            ->parameters(['admin' => 'admin']);
    });

// ─── User ────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
        Route::get('/jadwal', [UserDashboard::class, 'jadwal'])->name('jadwal');
    });

// ─── TailAdmin Demo Pages (ganti nama yang bentrok) ──────
// ─── Merapihkan routes demo dari TailAdmin ──────
Route::get('/papan', fn() => view('pages.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']))->name('dashboard.demo');
Route::get('/calendar', fn() => view('pages.calender', ['title' => 'Calendar']))->name('calendar');
Route::get('/profile-demo', fn() => view('pages.profile', ['title' => 'Profile']))->name('profile.demo');
Route::get('/form-elements', fn() => view('pages.form.form-elements', ['title' => 'Form Elements']))->name('form-elements');
Route::get('/basic-tables', fn() => view('pages.tables.basic-tables', ['title' => 'Basic Tables']))->name('basic-tables');
Route::get('/blank', fn() => view('pages.blank', ['title' => 'Blank']))->name('blank');
Route::get('/error-404', fn() => view('pages.errors.error-404', ['title' => 'Error 404']))->name('error-404');
Route::get('/line-chart', fn() => view('pages.chart.line-chart', ['title' => 'Line Chart']))->name('line-chart');
Route::get('/bar-chart', fn() => view('pages.chart.bar-chart', ['title' => 'Bar Chart']))->name('bar-chart');
Route::get('/signin', fn() => view('pages.auth.signin', ['title' => 'Sign In']))->name('signin');
Route::get('/signup', fn() => view('pages.auth.signup', ['title' => 'Sign Up']))->name('signup');
Route::get('/alerts', fn() => view('pages.ui-elements.alerts', ['title' => 'Alerts']))->name('alerts');
Route::get('/avatars', fn() => view('pages.ui-elements.avatars', ['title' => 'Avatars']))->name('avatars');
Route::get('/badge', fn() => view('pages.ui-elements.badges', ['title' => 'Badges']))->name('badges');
Route::get('/buttons', fn() => view('pages.ui-elements.buttons', ['title' => 'Buttons']))->name('buttons');
Route::get('/image', fn() => view('pages.ui-elements.images', ['title' => 'Images']))->name('images');
Route::get('/videos', fn() => view('pages.ui-elements.videos', ['title' => 'Videos']))->name('videos');