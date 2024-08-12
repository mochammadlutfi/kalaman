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
    
    Route::name('profile.')->group(function () {
        Route::get('/profil','ProfilController@edit')->name('edit');
        Route::post('/profil','ProfilController@update');
        
        Route::get('/password','ProfilController@password')->name('password');
        Route::post('/password','ProfilController@updatePassword');
    });
        
    Route::get('/pesanan-saya','OrderController@user')->name('user.order');
    Route::get('/pesanan-saya/{id}','OrderController@show')->name('user.order.show');
    Route::post('/pesanan/simpan','OrderController@register')->name('user.order.register');
    Route::get('/pesanan/{id}/pembayaran','OrderController@payment')->name('user.order.payment');
    Route::get('/pesanan/{id}/pembayaran/data','OrderController@paymentData')->name('user.order.payment.data');
    Route::get('/pesanan/{id}/project','ProjectController@index')->name('user.project');
    Route::get('/pesanan/{id}/project/{project}','ProjectController@show')->name('user.project.show');
    Route::get('/pesanan/{id}/project/{project}/task','ProjectController@task')->name('user.project.task');
    Route::get('/pesanan/{id}/project/{project}/kalender','ProjectController@calendar')->name('user.project.calendar');
    Route::post('/pesanan/{id}/update','OrderController@update')->name('user.order.update');    

    
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
                Route::post('/select','UserController@select')->name('select');
                Route::get('/create','UserController@create')->name('create');
                Route::post('/store','UserController@store')->name('store');
                Route::get('/json/{id}','UserController@json')->name('json');
                Route::get('/{id}','UserController@show')->name('show');
                Route::get('/{id}/edit','UserController@edit')->name('edit');
                Route::post('{id}/update','UserController@update')->name('update');
                Route::delete('/{id}/delete','UserController@destroy')->name('delete');
                Route::get('/{id}/riwayat','UserController@riwayat')->name('riwayat');
            });

            Route::prefix('/order')->name('order.')->group(function () {
                Route::get('/','OrderController@index')->name('index');
                Route::get('/create','OrderController@create')->name('create');
                Route::post('/store','OrderController@store')->name('store');
                Route::post('/status','OrderController@status')->name('status');
                Route::post('/select','OrderController@select')->name('select');
                Route::get('/report','OrderController@report')->name('report');
                Route::get('/json','OrderController@json')->name('json');
                Route::get('/{id}','OrderController@show')->name('show');
                Route::get('/{id}/edit','OrderController@edit')->name('edit');
                Route::post('{id}/update','OrderController@update')->name('update');
                Route::delete('/{id}/delete','OrderController@destroy')->name('delete');
                Route::get('/{id}/peserta','UserOrderController@index')->name('peserta');
                Route::post('/{id}/peserta/store','UserOrderController@store')->name('peserta.store');
                Route::delete('/{id}/peserta/delete','UserOrderController@destroy')->name('peserta.delete');
                Route::get('/{id}/peserta/{user}/certificate','UserOrderController@certificate')->name('peserta.certificate');
            });
            
            Route::prefix('/project')->name('project.')->group(function () {
                Route::get('/','ProjectController@index')->name('index');
                Route::get('/tambah','ProjectController@create')->name('create');
                Route::post('/simpan','ProjectController@store')->name('store');
                Route::get('/{id}','ProjectController@show')->name('show');
                Route::get('/{id}/kalender','ProjectController@calendar')->name('calendar');
                Route::get('/{id}/edit','ProjectController@edit')->name('edit');
                Route::post('{id}/confirm','ProjectController@confirm')->name('confirm');
                Route::post('{id}/update','ProjectController@update')->name('update');
                Route::delete('/{id}/delete','ProjectController@destroy')->name('delete');
            });

            
            Route::prefix('/task')->name('task.')->group(function () {
                Route::get('/','TaskController@index')->name('index');
                Route::get('/json','TaskController@json')->name('json');
                Route::get('/tambah','TaskController@create')->name('create');
                Route::post('/simpan','TaskController@store')->name('store');
                Route::get('/{id}','TaskController@show')->name('show');
                Route::get('/{id}/edit','TaskController@edit')->name('edit');
                Route::post('{id}/confirm','TaskController@confirm')->name('confirm');
                Route::post('{id}/update','TaskController@update')->name('update');
                Route::delete('/{id}/delete','TaskController@destroy')->name('delete');
            });

            Route::prefix('/paket')->name('paket.')->group(function () {
                Route::get('/','PaketController@index')->name('index');
                Route::get('/create','PaketController@create')->name('create');
                Route::post('/store','PaketController@store')->name('store');
                Route::post('/select','PaketController@select')->name('select');
                Route::get('/json','PaketController@json')->name('json');
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
                Route::get('/report','PembayaranController@report')->name('report');
                Route::get('/{id}','PembayaranController@show')->name('show');
                Route::get('/{id}/edit','PembayaranController@edit')->name('edit');
                Route::post('{id}/update','PembayaranController@update')->name('update');
                Route::post('{id}/status','PembayaranController@status')->name('status');
                Route::delete('/{id}/delete','PembayaranController@destroy')->name('delete');
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
