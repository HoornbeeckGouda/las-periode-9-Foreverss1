<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolcareerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\courseController;
use App\Http\Controllers\classController;
use App\Http\Controllers\subjectresultController;
use App\Http\Controllers\PermissionController;


Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('student', StudentsController::class);
Route::resource('schoolcareer', SchoolcareerController::class);
Route::resource('course', courseController::class);
Route::resource('class', classController::class);

//subject result edit and create routes
Route::get('subjectresults/create/{subjectId}', [courseController::class, 'createSubjectResult'])->name('subjectresults.create');
Route::post('subjectresults/store/{subjectId}', [courseController::class, 'storeSubjectResult'])->name('subjectresults.store');
Route::get('subjectresults/edit/{id}', [courseController::class, 'editSubjectResult'])->name('subjectresults.edit');
Route::put('subjectresults/update/{id}', [courseController::class, 'updateSubjectResult'])->name('subjectresults.update');


require __DIR__.'/auth.php';
