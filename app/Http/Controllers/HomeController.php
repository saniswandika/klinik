<?php

namespace App\Http\Controllers;

use App\Models\obat;
use App\Models\Pembayaran;
use App\Models\pendaftaran_pasien;
use App\Models\tindakan_medis;
use App\Models\vitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Phpml\Classification\DecisionTree;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name','users.id')
        ->where('users.name', Auth::user()->name )
        ->first(); 
        // dd($userlogin);
        // Mendapatkan tanggal hari ini
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Menghitung jumlah pendaftaran pasien minggu ini
        // if ($userlogin->name == 'perawat') {
        //     $registrations = vitalSign::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
        //     $mingguini = vitalSign::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
        //     $bulanini = vitalSign::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
        //     ->where('created_by', $userlogin->id)
        //     ->groupBy('month')
        //     ->get();
        //     $months = $bulanini->map(function ($item) {
        //         return Carbon::create()->month($item->month)->format('F');
        //     });
        //     $totals = $bulanini->pluck('total')->toArray();
        // }elseif($userlogin->name == 'Dokter'){
        //     $registrations = tindakan_medis::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
        //     $mingguini = tindakan_medis::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
        //     $bulanini = tindakan_medis::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
        //     ->where('created_by', $userlogin->id)
        //     ->groupBy('month')
        //     ->get();
        //     $months = $bulanini->map(function ($item) {
        //         return Carbon::create()->month($item->month)->format('F');
        //     });
        //     $totals = $bulanini->pluck('total')->toArray();
        // }elseif($userlogin->name == 'kasir'){
        //     $registrations = Pembayaran::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
        //     $mingguini = Pembayaran::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
        //     $bulanini = Pembayaran::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
        //     ->where('created_by', $userlogin->id)
        //     ->groupBy('month')
        //     ->get();
        //     // dd($userlogin);
        //     $months = $bulanini->map(function ($item) {
        //         return Carbon::create()->month($item->month)->format('F');
        //     });
        //     $totals = $bulanini->pluck('total')->toArray();
        // }elseif($userlogin->name == 'klinik'){
        //     $registrations = obat::whereDate('created_at', $today)->count();
        //     $mingguini = obat::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        //     $bulanini = obat::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
        //     ->groupBy('month')
        //     ->get();
        //     // dd($userlogin);
        //     $months = $bulanini->map(function ($item) {
        //         return Carbon::create()->month($item->month)->format('F');
        //     });
        //     $totals = $bulanini->pluck('total')->toArray();
        // }
        switch ($userlogin) {
            case $userlogin->name =='Admin':
                $perawat = DB::table('model_has_roles')
                // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->select('roles.name','users.id')
                ->where('roles.name','perawat')
                ->count(); 
                $Dokter = DB::table('model_has_roles')
                // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->select('roles.name','users.id')
                ->where('roles.name','Dokter')
                ->count(); 
                $klinik = DB::table('model_has_roles')
                // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->select('roles.name','users.id')
                ->where('roles.name','klinik')
                ->count(); 
                $kasir = DB::table('model_has_roles')
                // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->select('roles.name','users.id')
                ->where('roles.name','kasir')
                ->count(); 
                $pasien = DB::table('model_has_roles')
                // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
                ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                // ->select('roles.name','users.id')
                ->where('roles.name','pasien')
                ->count(); 
                // dd($userlogin);
                return view('dashboard_admin', compact('perawat','Dokter','klinik','kasir','pasien'));
            break;
            case $userlogin->name =='perawat':
                $registrations = vitalSign::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
                $mingguini = vitalSign::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
                $bulanini = vitalSign::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
                ->where('created_by', $userlogin->id)
                ->groupBy('month')
                ->get();
                $months = $bulanini->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F');
                });
                // dd($months);
                $totals = $bulanini->pluck('total')->toArray();
            break;
            case $userlogin->name == 'Dokter':
                $registrations = tindakan_medis::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
                $mingguini = tindakan_medis::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
                $bulanini = tindakan_medis::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
                ->where('created_by', $userlogin->id)
                ->groupBy('month')
                ->get();
                $months = $bulanini->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F');
                });
                $totals = $bulanini->pluck('total')->toArray();
            break;
            case $userlogin->name =='kasir':
                $registrations = Pembayaran::whereDate('created_at', $today)->where('created_by', $userlogin->id)->count();
                $mingguini = Pembayaran::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('created_by', $userlogin->id)->count();
                $bulanini = Pembayaran::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
                ->where('created_by', $userlogin->id)
                ->groupBy('month')
                ->get();

                $months = $bulanini->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F');
                });
                $totals = $bulanini->pluck('total')->toArray();
            break;
            case $userlogin->name =='klinik':
                $registrations = obat::all('created_at', $today)->count();
                $mingguini = obat::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                $bulanini = obat::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
                ->groupBy('month')
                ->get();
                // dd($userlogin);
                $months = $bulanini->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F');
                });
                $totals = $bulanini->pluck('total')->toArray();
            break;
            default:
                # code...
                break;
        }
        
        // Mengubah angka bulan menjadi nama bulan
        if ($userlogin->name == 'pasien') {
           
            return view('dashboard.index');
        }elseif($userlogin->name == 'klinik'){
            return view('obat.dashboard_index', compact('userlogin','registrations','mingguini','months','totals'));
        }else{
            return view('home', compact('userlogin','registrations','mingguini','months','totals'));
        }
    }
    // public function dataset()
    // {
    //     $datasets = vitalSign::get();
    //     // $datasets = DB::table('vitalsign')->get();

    //     // // Implementasi algoritma C4.5 untuk perhitungan klasifikasi
    //     $decisionTree = $this->buildDecisionTree($datasets);
    //     dd($datasets);
    //     return view('classifier.index', compact('datasets', 'decisionTree'));
    // }
    public function dataset(vitalSign $obat)
    {
        // $datasets = vitalSign::get();
        $babyData = vitalSign::find($obat->id_obat);
        // Ambil dataset dari sumber data atau database Anda
        $dataset  = $this->getDataset();
        dd($dataset);
        // Proses data training
        $samples = [];
        $labels = [];
        
        foreach ($dataset as $data) {
            $samples[] = $this->preprocessData($data);
            $labels[] = $data['gizi_status'];
        }
        
        // Inisialisasi model pohon keputusan
        $decisionTree = new DecisionTree();
        
        // Proses pembelajaran (training) model
        $decisionTree->train($samples, $labels);
        
        // Lakukan prediksi pada data bayi yang masuk
        $prediction = $decisionTree->predict($this->preprocessData($babyData));
        
        return response()->json([
            'prediction' => $prediction,
        ]);
    }

    private function getDataset()
    {
        // Mengambil dataset dari sumber data atau database Anda
        // Contoh dataset berikut adalah dataset sederhana untuk ilustrasi
        
        return [
            ['gizi_status' => 'gizi buruk', 'berat_badan' => 2.5, 'panjang_badan' => 45],
            ['gizi_status' => 'normal', 'berat_badan' => 3.1, 'panjang_badan' => 48],
            ['gizi_status' => 'gizi rendah', 'berat_badan' => 2.7, 'panjang_badan' => 46],
            // ...
        ];
    }
    private function preprocessData($data)
    {
        // Lakukan pra-pemrosesan data, seperti normalisasi, pemilihan fitur, atau encoding
        // Contoh sederhana: Menggunakan fitur berat_badan dan panjang_badan
        // dd($data);
        $classMapping = [
            'gizi buruk' => 0,
            'gizi rendah' => 1,
            'normal' => 2,
        ];
        dd($data);
        $preprocessedData = [$data['berat_badan'], $data['panjang_badan']];
    
        // Periksa apakah nilai 'gizi_status' adalah null sebelum mengakses array offset
        $giziStatus = $data['gizi_status'] ?? null;
        if ($giziStatus !== null && array_key_exists($giziStatus, $classMapping)) {
            $preprocessedData[] = $classMapping[$giziStatus];
        }
        
        return $preprocessedData;
    }    

}
