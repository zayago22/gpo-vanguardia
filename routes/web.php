<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\TestimonioController;
use App\Http\Controllers\Admin\RedSocialController;
use App\Http\Controllers\Admin\ContactoAdminController;
use App\Http\Controllers\Admin\ValorController;
use Illuminate\Support\Facades\Route;

// ===== RUTAS PÚBLICAS =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cctv', [HomeController::class, 'cctv'])->name('cctv');
Route::post('/contacto', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contacto.store');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// ===== ADMIN ROUTES =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('servicios', ServicioController::class);
    Route::resource('posts', PostController::class);
    Route::resource('galeria', GaleriaController::class);
    Route::resource('testimonios', TestimonioController::class);
    Route::resource('redes-sociales', RedSocialController::class)->parameters(['redes-sociales' => 'redSocial']);
    Route::resource('valores', ValorController::class);
    Route::get('/contactos', [ContactoAdminController::class, 'index'])->name('contactos.index');
    Route::patch('/contactos/{contact}/leido', [ContactoAdminController::class, 'marcarLeido'])->name('contactos.leido');
    Route::delete('/contactos/{contact}', [ContactoAdminController::class, 'destroy'])->name('contactos.destroy');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
