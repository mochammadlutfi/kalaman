<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/','LandingController@index')->name('home');
Route::get('/tentang-kami','LandingController@about')->name('about');

Route::get('/login','AuthController@showLogin')->name('login');
Route::post('/login','AuthController@login');
Route::get('/daftar','AuthController@showRegister')->name('register');
Route::post('/daftar','AuthController@register');

Route::prefix('/training')->name('training.')->group(function () {
    Route::get('/','TrainingController@index')->name('index');
    Route::get('/{slug}','TrainingController@show')->name('show');
});

Route::prefix('/layanan-kami')->name('services.')->group(function () {
    Route::get('/it-training','ServiceController@training')->name('training');
    Route::get('/it-consultant','ServiceController@consultant')->name('consultant');
    Route::get('/project','ServiceController@project')->name('project');
});

Route::middleware('auth')->group(function () {
    Route::post('/keluar','AuthController@logout')->name('logout');
    
    Route::name('profil.')->group(function () {
        Route::get('/profil','ProfilController@edit')->name('edit');
        Route::post('/profil','ProfilController@update');
        
        Route::get('/password','ProfilController@password')->name('password');
        Route::post('/password','ProfilController@updatePassword');
    });
        
    Route::get('/pelatihan-saya','TrainingController@user')->name('user.training');
    Route::get('/pelatihan-saya/{id}','TrainingController@showTrans')->name('user.training.show');
    Route::post('/pelatihan/simpan','TrainingController@register')->name('user.training.register');
    Route::post('/pelatihan/update','TrainingController@update')->name('user.training.update');
    Route::get('/pelatihan/certificate/{id}','TrainingController@certificate')->name('user.training.certificate');
    
});

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    
    Route::middleware('guest:admin')->group(function () {
        Route::get('/','LoginController@showLoginForm')->name('login');
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout','LoginController@logout')->name('logout');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::post('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

        Route::middleware('verified')->group(function () {
            Route::get('/dashboard','DashboardController@index')->name('beranda');
            
            Route::prefix('/konsumen')->name('user.')->group(function () {
                Route::get('/','UserController@index')->name('index');
                Route::get('/create','UserController@create')->name('create');
                Route::post('/store','UserController@store')->name('store');
                Route::get('/json/{id}','UserController@json')->name('json');
                Route::get('/{id}','UserController@show')->name('show');
                Route::get('/{id}/edit','UserController@edit')->name('edit');
                Route::post('{id}/update','UserController@update')->name('update');
                Route::delete('/{id}/delete','UserController@destroy')->name('delete');
                Route::get('/{id}/riwayat','UserController@riwayat')->name('riwayat');
            });

            Route::prefix('/training')->name('training.')->group(function () {
                Route::get('/','TrainingController@index')->name('index');
                Route::get('/create','TrainingController@create')->name('create');
                Route::post('/store','TrainingController@store')->name('store');
                Route::post('/status','TrainingController@status')->name('status');
                Route::get('/{id}','TrainingController@show')->name('show');
                Route::get('/{id}/edit','TrainingController@edit')->name('edit');
                Route::post('{id}/update','TrainingController@update')->name('update');
                Route::delete('/{id}/delete','TrainingController@destroy')->name('delete');
                Route::get('/{id}/peserta','UserTrainingController@index')->name('peserta');
                Route::post('/{id}/peserta/store','UserTrainingController@store')->name('peserta.store');
                Route::delete('/{id}/peserta/delete','UserTrainingController@destroy')->name('peserta.delete');
                Route::get('/{id}/peserta/{user}/certificate','UserTrainingController@certificate')->name('peserta.certificate');
            });
            

            Route::prefix('/paket')->name('paket.')->group(function () {
                Route::get('/','PaketController@index')->name('index');
                Route::get('/create','PaketController@create')->name('create');
                Route::post('/store','PaketController@store')->name('store');
                Route::get('/{id}','PaketController@show')->name('show');
                Route::get('/{id}/edit','PaketController@edit')->name('edit');
                Route::post('{id}/update','PaketController@update')->name('update');
                Route::delete('/{id}/delete','PaketController@destroy')->name('delete');
            });

            Route::prefix('/kategori')->name('kategori.')->group(function () {
                Route::get('/','KategoriController@index')->name('index');
                Route::post('/store','KategoriController@store')->name('store');
                Route::get('/{id}','KategoriController@show')->name('show');
                Route::get('/{id}/edit','KategoriController@edit')->name('edit');
                Route::post('/{id}/update','KategoriController@update')->name('store');
                Route::delete('/{id}/delete','KategoriController@destroy')->name('delete');
            });

            Route::prefix('/pembayaran')->name('payment.')->group(function () {
                Route::get('/','PembayaranController@index')->name('index');
                Route::get('/create','PembayaranController@create')->name('create');
                Route::post('/store','PembayaranController@store')->name('store');
                Route::get('/{id}','PembayaranController@show')->name('show');
                Route::get('/{id}/edit','PembayaranController@edit')->name('edit');
                Route::post('{id}/update','PembayaranController@update')->name('update');
                Route::post('{id}/status','PembayaranController@status')->name('status');
                Route::delete('/{id}/delete','PembayaranController@destroy')->name('delete');
            });
        
            
            Route::prefix('/anggota')->name('anggota.')->group(function () {
                Route::get('/','AnggotaController@index')->name('index');
                Route::get('/tambah','AnggotaController@tambah')->name('tambah');
                Route::post('/simpan','AnggotaController@simpan')->name('simpan');
                Route::get('/baru','AnggotaController@baru')->name('baru');
                Route::get('/{id}','AnggotaController@show')->name('show');
                Route::get('/{id}/edit','AnggotaController@edit')->name('edit');
                Route::post('{id}/confirm','AnggotaController@confirm')->name('confirm');
                Route::post('{id}/update','AnggotaController@update')->name('update');
                Route::delete('/{id}/delete','AnggotaController@destroy')->name('delete');
            });

            Route::prefix('/pegawai')->name('pegawai.')->group(function () {
                Route::get('/','PegawaiController@index')->name('index');
                Route::get('/data','PegawaiController@data')->name('data');
                Route::get('/create','PegawaiController@create')->name('create');
                Route::post('/store','PegawaiController@store')->name('store');
                Route::get('/{id}','PegawaiController@show')->name('show');
                Route::get('/{id}/edit','PegawaiController@edit')->name('edit');
                Route::post('{id}/update','PegawaiController@update')->name('update');
                Route::delete('/{id}/delete','PegawaiController@destroy')->name('delete');
            });

        });
    });
});


// require __DIR__.'/auth.php';
