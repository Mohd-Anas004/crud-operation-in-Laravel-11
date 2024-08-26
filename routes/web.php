<?php


use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\CrudModel;
use App\Models\Auth;

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

Route::controller(FormController::class)->group(function () {
    Route::get('/form', 'index');
    Route::post('/formdata', 'upload');
    Route::get('/edit/{id}', 'editData');
    Route::get('/', 'ViewData')->name('view');
    Route::post('/update/{id}', 'updateData');
    Route::get('/delete/{id}', 'deleteData');
});
// Route::get('/data',function(){

// }

// );

// Route::get('/', function () {
//     return view('view');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
