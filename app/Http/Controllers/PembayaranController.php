<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\pendaftaran_pasien;
use App\Models\antrian;
use App\Models\obat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return view('pembayaran.index');
    }
    public function getdataPasienPembayaran(Request $request)
    {
        $user_name = Auth::user()->name;
     
        // dd($user_wilayah->name);
        // $query = DB::table('pendaftaran_pasiens')
        //     ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
        //     // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
        //     ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        //     ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
        //     // ->where('pendaftaran_pasiens.status','pembayaran')
        //     ->distinct();
        $today = Carbon::today();
        $query = DB::table('tindakan_medis')
        ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->leftjoin('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
        ->leftJoin('antrians', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
        ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
        // ->leftjoin('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
        // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
        // ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->select('tindakan_medis.*','users.name','pendaftaran_pasiens.*','antrians.Nomor_antrian')
        // ->where('pendaftaran_pasiens.created_by',$user_name)
        ->whereDate('pendaftaran_pasiens.created_at', '=', $today)
        ->distinct();

        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pendaftaran_pasiens.Nama_pasien', 'like', "%$search%");
            });
        }
        $total_filtered_items = $query->count();
        $start = $request->start;
        $length = $request->length;
        $query->offset($start)->limit($length);
        $data = $query->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => pendaftaran_pasien::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }
    public function getdataProsesPembayaran(Request $request)
    {
        $user_name = Auth::user()->name;
     
        // dd($user_wilayah->name);
        $query =  DB::table('pembayarans')
        ->join('detail_tindakan_medis', 'pembayarans.id_detail_tindakan_medis', '=', 'detail_tindakan_medis.id')
        ->join('tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
        ->join('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
        ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
        ->join('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
        ->select('vitalsign.*','pembayarans.*', 'detail_tindakan_medis.*','tindakan_medis.*','pendaftaran_pasiens.*','antrians.Nomor_antrian');
        // ->get();
        // dd($query);
        // dd($query);
       
        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pendaftaran_pasiens.Nama_pasien', 'like', "%$search%");
            });
        }
        $total_filtered_items = $query->count();
        $start = $request->start;
        $length = $request->length;
        $query->offset($start)->limit($length);
        $data = $query->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => pendaftaran_pasien::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $obatIds = $request->get('id_obat');
        // dd($request->all());
        $pembayaran = new pembayaran;
        $pembayaran->id_detail_tindakan_medis =  $request->get('id_detail_tindakan_medis');
        $pembayaran->tanggal_pembayaran =  $request->get('tanggal_pembayaran');
        $pembayaran->total_pembayaran = $request->get('total_pembayaran');
        $pembayaran->metode_pembayaran =  $request->get('metode_pembayaran');
        $pembayaran->cashless_details =  $request->get('cashless_details');
        $pembayaran->created_by =  auth::user()->id;
   
        
        // $pembayaran->id_dokter = $request->get('id_dokter'); ;
        $pembayaran->save();
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return view('pembayaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $vitalSign = DB::table('vitalsign')
        ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
        ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
        ->join('pendaftaran_pasiens', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->join('tindakan_medis', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
        ->join('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
        ->join('pembayarans', 'pembayarans.id_detail_tindakan_medis', '=', 'detail_tindakan_medis.id')
        ->select('pembayarans.*','detail_tindakan_medis.*','tindakan_medis.*','vitalsign.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name','pendaftaran_pasiens.*')
        ->where('pendaftaran_pasiens.id', $id)->first();
    // dd($vitalSign);
        $obat = DB::table('detail_tindakan_medis')
        // ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
        // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
        ->select('obats.*')
        ->where('detail_tindakan_medis.id_tindakan_medis',$vitalSign->id_tindakan_medis)->get();
        return view('pembayaran.show',compact('vitalSign','obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pembayaran $pembayaran)
    {
        //
    }
    public function proses($id)
    {
    $data_pasien = DB::table('vitalsign')
        // ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
        ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
        ->join('pendaftaran_pasiens', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->join('tindakan_medis', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
        // ->join('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
        ->join('detail_tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
        ->join('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->select('users.id','users.name','tindakan_medis.*','vitalsign.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name','pendaftaran_pasiens.*')
        ->where('pendaftaran_pasiens.id', $id)->first();

    $tindakan_medis = DB::table('detail_tindakan_medis')
        ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
        // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        // ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
        ->select('tindakan_medis.*','detail_tindakan_medis.*')
        ->where('tindakan_medis.id_tindakan_medis',$data_pasien->id_tindakan_medis)->first();
    // dd($data_pasien);
    $obat = DB::table('detail_tindakan_medis')
        // ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
        // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
        ->select('obats.*')
        ->where('detail_tindakan_medis.id_tindakan_medis',$data_pasien->id_tindakan_medis)->get();
        $totalHargaObat = 0;
        foreach ($obat as $detail) {
            $hargaObat = $detail->harga_obat;
            $totalHargaObat += $hargaObat;
        }
        // dd($totalHargaObat);
    // return view('tindakan_medis.show', compact('obat','tindakan_medis','vitalSign'));
        return view('pembayaran.create',compact('totalHargaObat','obat','data_pasien','tindakan_medis'));
    }
    public function cetakStruk($id)
    {
        // $PelaporanPub = rekomendasi_terdaftar_yayasan::find($id);
        $vitalSign = DB::table('vitalsign')
            ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
            ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            ->join('pendaftaran_pasiens', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->join('tindakan_medis', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
            ->join('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
            ->join('pembayarans', 'pembayarans.id_detail_tindakan_medis', '=', 'detail_tindakan_medis.id')
            ->select('pembayarans.*','detail_tindakan_medis.*','tindakan_medis.*','vitalsign.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name','pendaftaran_pasiens.*')
            ->where('pendaftaran_pasiens.id', $id)->first();
        // dd($vitalSign);
        $obat = DB::table('detail_tindakan_medis')
            // ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
            // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
            ->select('obats.*')
            ->where('detail_tindakan_medis.id_tindakan_medis',$vitalSign->id_tindakan_medis)->get();
        $tindakan_medis = DB::table('detail_tindakan_medis')
            ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
            ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            // ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
            ->select('users.id','users.name','tindakan_medis.*','detail_tindakan_medis.*')
            ->where('tindakan_medis.id_tindakan_medis',$vitalSign->id_tindakan_medis)->first();
        $pdf = PDF::loadHtml(view('pembayaran.struk_pembayaran',compact('vitalSign','obat','tindakan_medis')));
        $filename = 'File Permohonan' . $tindakan_medis->id_tindakan_medis . '.pdf';
        return $pdf->stream($filename);
        
    }
}
