<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        // users
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users.data', [UserController::class, 'data'])->name('users.data');
        Route::get('users.role', [UserController::class, 'role'])->name('users.role');
        Route::post('users.store', [UserController::class, 'store'])->name('users.store');
        Route::get('users.dataById', [UserController::class, 'dataById'])->name('users.dataById');

        // permission
        Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('permission.data', [PermissionController::class, 'data'])->name('permission.data');
        Route::post('permission.store', [PermissionController::class, 'store'])->name('permission.store');
        Route::post('permission.destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
        Route::get('permission.dataById', [PermissionController::class, 'dataById'])->name('permission.dataById');
        Route::post('permission.update', [PermissionController::class, 'update'])->name('permission.update');


        // role
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role.data', [RoleController::class, 'data'])->name('role.data');
        Route::post('role.simpan', [RoleController::class, 'store'])->name('role.store');
        Route::post('role.destroy', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::post('role.update', [RoleController::class, 'update'])->name('role.update');
        Route::get('role.dataById', [RoleController::class, 'dataById'])->name('role.dataById');
        Route::get('permissionForROle', [RoleController::class, 'permission'])->name('role.permission');

        // tahun
        Route::get('tahun', [TahunController::class, 'index'])->name('tahun.index');
        Route::get('tahun.data', [TahunController::class, 'data'])->name('tahun.data');
        Route::get('tahun.dataByID', [TahunController::class, 'dataById'])->name('tahun.dataById');
        Route::post('tahun.stroe', [TahunController::class, 'store'])->name('tahun.store');
        Route::post('tahun.update', [TahunController::class, 'update'])->name('tahun.update');
        Route::post('tahun.destroy', [TahunController::class, 'destroy'])->name('tahun.destroy');

        // barang
        Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
        Route::get('barang.data', [BarangController::class, 'data'])->name('barang.data');
        Route::get('barang.dataById', [BarangController::class, 'dataById'])->name('barang.dataById');
        Route::post('barang.store', [BarangController::class, 'store'])->name('barang.store');
        Route::post('barang.update', [BarangController::class, 'update'])->name('barang.update');
        Route::post('barang.destroy', [BarangController::class, 'destroy'])->name('barang.destroy');


        // sub barang
        Route::get('sub_barang.data', [BarangController::class, 'data_sub_barang'])->name('data_sub_barang');
        Route::post('sub_barang.store', [BarangController::class, 'sub_barang_store'])->name('barang.sub_barang.store');
        Route::post('sub_barang.destroy', [BarangController::class, 'sub_barang_destroy'])->name('barang.sub_barang_destroy');
        Route::get('sub_barang.dataById', [BarangController::class, 'sub_barangById'])->name('barang.sub_barangById');
        Route::post('sub_barang.update', [BarangController::class, 'sub_barangUpdate'])->name('barang.sub_barangUpdate');


        // parameter_barang
        Route::get('data_parameter_barang', [BarangController::class, 'data_parameter_barang'])
            ->name('data_parameter_barang');
        Route::post('store_parameter_barang', [BarangController::class, 'store_parameter_barang'])
            ->name('store_parameter_barang');
        Route::post('parameter_barang_destroy', [BarangController::class, 'parameter_barang_destroy'])
            ->name('parameter_barang_destroy');
        Route::get('dataParameterBarangById', [BarangController::class, 'dataParameterBarangById'])
            ->name('dataParameterBarangById');
        Route::post('parameterBarangUpdate', [BarangController::class, 'parameterBarangUpdate'])
            ->name('parameterBarangUpdate');

        // spesifikasi parameter
        Route::get('data_spesifikasi_paramemter', [BarangController::class, 'data_spesifikasi_paramemter'])
            ->name('data_spesifikasi_paramemter');
        Route::get('spesifikasiParameterById', [BarangController::class, 'spesifikasiParameterById'])
            ->name('spesifikasiParameterById');
        Route::post('store_spesifikasi_parameter', [BarangController::class, 'store_spesifikasi_parameter'])
            ->name('store_spesifikasi_parameter');
        Route::post('sepsifikasiParameterDestroy', [BarangController::class, 'sepsifikasiParameterDestroy'])
            ->name('sepsifikasiParameterDestroy');
        Route::post('spesifikasiParameterUpdate', [BarangController::class, 'spesifikasiParameterUpdate'])
            ->name('spesifikasiParameterUpdate');
        Route::get('formTambahSpesifkkasiSubBarang', [BarangController::class, 'formTambahSpesifkkasiSubBarang'])
            ->name('formTambahSpesifkkasiSubBarang');


        // spesifikasi sub barang
        Route::get('spesifikasi_sub_barang.data', [BarangController::class, 'data_spesifikasi_sub_barang'])
            ->name('data_spesifikasi_sub_barang');
        Route::post('ptambah_spesifkasi_sub_barang', [BarangController::class, 'ptambah_spesifkasi_sub_barang'])
            ->name('ptambah_spesifkasi_sub_barang');


        // unit
        Route::get('unit', [UnitController::class, 'index'])->name('unit.index');
        Route::post('unit.store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('unit.data', [UnitController::class, 'data'])->name('unit.data');
        Route::post('unit.destroy', [UnitController::class, 'destroy'])->name('unit.destroy');
        Route::get('unit.dataById', [UnitController::class, 'dataById'])->name('unit.dataById');
        Route::post('unit.update', [UnitController::class, 'update'])->name('unit.update');


        // pengadaan
        Route::get('pengadaan', [PengadaanController::class, 'index'])
            ->name('pengadaan');
        Route::get('pengadaan.data', [PengadaanController::class, 'data'])
        ->name('pengadaan.data');
        Route::get('pengadaan/h-tambah', [PengadaanController::class, 'h_tambah'])
            ->name('pengadaan.h_tambah');
        Route::get('pengadaan/list_tahun', [PengadaanController::class, 'list_tahun'])
            ->name('pengadaan.list_tahun');
        Route::get('pengadaan/list-unit', [PengadaanController::class, 'list_unit'])
        ->name('pengadaan.list_unit');
        Route::post('pengadaan.simpan', [PengadaanController::class, 'simpan'])
        ->name('pengadaan.simpan');
        Route::get('pengadaan/detail/{id}', [PengadaanController::class, 'detail'])
        ->name('pengadaan.detail');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
