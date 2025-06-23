<?php

use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EcoJourneyController;
use App\Http\Controllers\EcoLearnController;
use App\Http\Controllers\EcoMissionController;
use App\Http\Controllers\EcoSubMissionController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/register', [AuthController::class, 'doRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::resource('articles', ArticleController::class);

Route::get('/eco-learn', [EcoLearnController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/eco-learn/create', [EcoLearnController::class, 'create']);
    Route::post('/eco-learn', [EcoLearnController::class, 'store']);
    Route::get('/eco-learn/{id}/edit', [EcoLearnController::class, 'edit'])->middleware('auth');
    Route::put('/eco-learn/{id}', [EcoLearnController::class, 'update'])->middleware('auth');
    Route::delete('/eco-learn/{id}', [EcoLearnController::class, 'destroy'])->middleware(['auth', 'is_admin']);
    // Route::post('/eco-learn/{id}/comments', [CommentController::class, 'store'])->name('comments.store');


    // Route::get('/eco-journey', [EcoJourneyController::class, 'index'])->name('eco-journey.index');
    // Route::get('/eco-journey/mission/{id}', [EcoJourneyController::class, 'showMission'])->name('eco-journey.show');
    // Route::post('/eco-journey/mission/{id}/submit', [EcoJourneyController::class, 'submitMission'])->name('eco-journey.submit');
});
Route::get('/eco-learn/{id}', [EcoLearnController::class, 'show'])->name('eco-learn.show');

Route::get('/eco-games', [GameController::class, 'index'])->name('eco-games.index');

// Admin
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/articles', [AdminUserController::class, 'showUserArticles'])->name('admin.users.articles');

    Route::get('/admin/eco-learn', [EcoLearnController::class, 'admin']);
    Route::post('/admin/eco-learn/{id}/approve', [EcoLearnController::class, 'approve']);
    Route::post('/admin/eco-learn/{id}/reject', [EcoLearnController::class, 'reject']);

    Route::get('/admin/games', [AdminGameController::class, 'index'])->name('admin.games.index');
    Route::get('/admin/games/create', [AdminGameController::class, 'create'])->name('admin.games.create');
    Route::post('/admin/games', [AdminGameController::class, 'store'])->name('admin.games.store');
    Route::get('/admin/games/{id}/edit', [AdminGameController::class, 'edit'])->name('admin.games.edit');
    Route::put('/admin/games/{id}', [AdminGameController::class, 'update'])->name('admin.games.update');
    Route::delete('/admin/games/{id}', [AdminGameController::class, 'destroy'])->name('admin.games.destroy');

    // Route::get('admin/eco-journey/submissions', [EcoSubMissionController::class, 'index'])->name('admin.submissions.index');
    // Route::post('admin/eco-journey/submissions/{id}/approve', [EcoSubmissionController::class, 'approve'])->name('admin.submissions.approve');
    // Route::post('admin/eco-journey/submissions/{id}/reject', [EcoSubmissionController::class, 'reject'])->name('admin.submissions.reject');
});

// Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
//     Route::get('/eco-journey/missions', [EcoMissionController::class, 'index'])->name('missions.index');
//     Route::get('/eco-journey/missions/create', [EcoMissionController::class, 'create'])->name('missions.create');
//     Route::post('/eco-journey/missions', [EcoMissionController::class, 'store'])->name('missions.store');
//     Route::get('/eco-journey/missions/{mission}/edit', [EcoMissionController::class, 'edit'])->name('missions.edit');
//     Route::put('/eco-journey/missions/{mission}', [EcoMissionController::class, 'update'])->name('missions.update');
//     Route::delete('/eco-journey/missions/{mission}', [EcoMissionController::class, 'destroy'])->name('missions.destroy');
// });