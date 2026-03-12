<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Models\Media;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $videos = Media::where('type', 'video')->get();
    $images = Media::where('type', 'image')->get();
    return view('welcome', compact('videos', 'images'));
})->name('welcome');

Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/galleries', [FrontendController::class, 'galleries'])->name('galleries');
Route::get('/galleries/{id}', [FrontendController::class, 'show'])->name('galleries.show');
Route::get('/inquiry', [FrontendController::class, 'inquiry'])->name('inquiry');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    
    Route::prefix('/media')->group(function () {
        Route::get('/', [MediaController::class, 'media'])->name('media.index');
        Route::get('/create', [MediaController::class, 'create'])->name('media.create');
        Route::post('/', [MediaController::class, 'store'])->name('media.store');
        Route::get('/{media}/edit', [MediaController::class, 'edit'])->name('media.edit');
        Route::put('/{media}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    Route::prefix('/gallery')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::post('/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::get('/delete/{gallery}', [GalleryController::class, 'delete'])->name('gallery.delete');
    });
    
    Route::prefix('/admin')->group(function () {
        Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts.index');
        Route::get('/delete/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');
        Route::delete('/bulk-delete', [ContactController::class, 'bulkDelete'])->name('contacts.bulk-delete');
        
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/delete/{id}', [InquiryController::class, 'destroy'])->name('inquiries.delete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/settings', function () {
        return view('backend.settings.index');
    })->name('settings.index');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
