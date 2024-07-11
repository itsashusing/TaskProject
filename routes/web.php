<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

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
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'taskIndex'])->name('dashboard');
    Route::any('/addtask/{status?}/{id?}', [UserController::class, 'add_task'])->name('user.add_task');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard/{status?}', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::any('/admin/add_user/{status?}/{id?}', [AdminController::class, 'add_user'])->name('admin.add_user');
    Route::any('/logout', [AdminController::class, 'logout'])->name('admin.destroy');
});


Route::post('ajaxModal/{parameter}', function (Request $request, $parameter) {
    if (View::exists($parameter)) {

        return view($parameter, ['request' => $request->all()]);
    } else {
        abort(404);
    }
});


Route::post('files/{bladePath}', function (Request $request, $bladePath) {
    if (View::exists('dropdown_files/' . $bladePath)) {
        return view('dropdown_files/' . $bladePath, ['request' => $request->all()]);
    } else {
        abort(404);
    }
});

Route::get('admin/{bladePath}', function ($bladePath) {
    if (View::exists($bladePath)) {
        return view($bladePath);
    } else {
        abort(404);
    }
});

require __DIR__ . '/auth.php';
