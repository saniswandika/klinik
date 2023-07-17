<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VitalSignController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PrediksiGiziController;
use App\Http\Controllers\TindakanMedisController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('auth.login');
});
Route::resource('users', UserController::class);
Route::get('/form-prediksi', [PrediksiGiziController::class, 'index'])->name('form-prediksi');
Route::get('/perhitungan', [PrediksiGiziController::class, 'perhitungan'])->name('perhitungan');
// Route::post('/form-prediksi', 'PrediksiGiziController@index')->name('index');
// Route::get('/hasil-prediksi', 'PrediksiGiziController@prediksi')->name('hasil.prediksi');

Route::post('/baby_nutrition', [PrediksiGiziController::class, 'klasifikasiGiziBayi'])->name('baby_nutrition.predict');

Auth::routes();



Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
  
    Route::resource('profile', ProfileController::class);
    Route::post('profilepassword', [ProfileController::class, 'password_action'])->name('password.action');
    Route::post('profilenama', [ProfileController::class, 'name_action'])->name('nama.action');
    Route::post('profileemail', [ProfileController::class, 'email_action'])->name('email.action');
    Route::post('profiletlpn', [ProfileController::class, 'telepon_action'])->name('telepon.action');
    Route::post('alamat', [ProfileController::class, 'alamat'])->name('alamat.action');
    Route::post('jenis_kelamin', [ProfileController::class, 'jenis_kelamin'])->name('jenis_kelamin.action');

    // pendaftaran pasien route
    Route::resource('pendaftaran_pasien', PendaftaranPasienController::class);
    Route::get('getdata', [PendaftaranPasienController::class, 'getdata'])->name('getdata');
    Route::get('prosesPendaftaranPasien/{id}', [PendaftaranPasienController::class, 'prosesPendaftaranPasien'])->name('prosesPendaftaranPasien');
    // pendaftaran Obat route
    Route::resource('obat', ObatController::class);
    Route::get('getdataObat', [ObatController::class, 'getdataObat'])->name('getdataObat');
   
    // pendaftaran tindakan medis route 
    Route::resource('tindakan_medis', TindakanMedisController::class);
    Route::get('proses-tindak-medis/{id}', [TindakanMedisController::class, 'proses'])->name('proses-tindak-medis');
    Route::get('getdataTindakanMedis', [TindakanMedisController::class, 'getdataTindakanMedis'])->name('getdataTindakanMedis');
    Route::get('DataTindakanMedis', [TindakanMedisController::class, 'DataTindakanMedis'])->name('DataTindakanMedis');
    Route::get('hasilTindakanMedis', [TindakanMedisController::class, 'hasilTindakanMedis'])->name('hasilTindakanMedis');
  
    // vitalsign route
    Route::DELETE('vital_sign/{id}', [VitalSignController::class, 'destroy'])->name('vitalsign.delete');
    Route::get('hapusdata/{id}', [VitalSignController::class, 'hapusdata'])->name('hapusdata.getdata');
    Route::get('vital_sign/{id}', [VitalSignController::class, 'show'])->name('vitalsign.show');
    Route::POST('vital_sign', [VitalSignController::class, 'store'])->name('vital_sign.store');
    Route::get('vital_sign/{id}/edit', [VitalSignController::class, 'edit'])->name('vitalsign.edit');
    Route::POST('vital_sign/{id_vitalsign}', [VitalSignController::class, 'update'])->name('vitalsign.update');
    Route::get('vital_sign', [VitalSignController::class, 'index'])->name('vital_sign.index');
    Route::get('prosesVitalSign/{id}', [VitalSignController::class, 'proses'])->name('prosesVitalSign');
    Route::get('getdatavitalsign', [VitalSignController::class, 'getdatavitalsign'])->name('getdatavitalsign');
    Route::get('datavitalsign', [VitalSignController::class, 'datavitalsign'])->name('datavitalsign');
    
    // pembayaran route
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('proses_Pembayaran/{id}', [PembayaranController::class, 'proses'])->name('proses_Pembayaran');
    Route::get('getdataPembayaran', [PembayaranController::class, 'getdataPasienPembayaran'])->name('getdataPembayaran');
    Route::get('getdataProsesPembayaran', [PembayaranController::class, 'getdataProsesPembayaran'])->name('getdataProsesPembayaran');
    Route::get('cetakStruk/{id}', [PembayaranController::class, 'cetakStruk'])->name('cetakStruk');
    
    Route::resource('products', ProductController::class);

});