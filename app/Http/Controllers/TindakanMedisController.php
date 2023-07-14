<?php

namespace App\Http\Controllers;

use App\Models\detailtindakan;
use App\Models\obat;
use App\Models\tindakan_medis;
use App\Models\pendaftaran_pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class TindakanMedisController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tindakan_medis.index');
    }
    //PASIEN TINDAK MEDIS
    public function getdataTindakanMedis(Request $request)
    {
        $user_name = Auth::user()->name;
        $today = Carbon::today();
        // dd($today);
        // Menghitung jumlah pendaftaran pasien hari ini
        // $registrations = pendaftaran_pasien::whereDate('created_at', $today)->count();
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', Auth::user()->name )
        ->first(); 
        if ($userlogin->name == 'pasien') {
         
            $query = DB::table('pendaftaran_pasiens')
            ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
            ->where('pendaftaran_pasiens.created_by',$user_name)
            ->distinct();
            // dd($query);
        }else{
            $query = DB::table('vitalsign')
            ->leftJoin('antrians', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            // ->leftJoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            ->select('pendaftaran_pasiens.*', 'antrians.Nomor_antrian')
            ->whereDate('pendaftaran_pasiens.created_at', '=', $today)
            ->distinct();
        }

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
    public function DataTindakanMedis(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('pendaftaran_pasiens')
            ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
            // ->where('pendaftaran_pasiens.status', '=','pemeriksaan dokter')
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
        Alert::success('Edit Data Pasien Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
    }
    public function hasilTindakanMedis(Request $request)
    {
        $user_name = Auth::user()->name;
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', Auth::user()->name )
        ->first();
        if ($userlogin->name == 'pasien') {
            $query = DB::table('tindakan_medis')
            ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            ->leftjoin('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
            ->leftJoin('antrians', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            // ->leftjoin('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            // ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('tindakan_medis.*','users.name')
            ->where('pendaftaran_pasiens.created_by',$user_name)
            ->distinct();
            // dd($query);
        }elseif($userlogin->name == 'Dokter'){
            $query = DB::table('tindakan_medis')
            ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            ->leftjoin('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
            // ->leftjoin('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            ->select('tindakan_medis.*','users.name','antrians.Nomor_antrian','pendaftaran_pasiens.Nama_pasien')
            ->where('tindakan_medis.created_by', '=', auth::user()->id);
            // ->get();
            // dd($query);
        }else{
            $query = DB::table('tindakan_medis')
            ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            ->leftjoin('vitalsign', 'vitalsign.id_vitalsign', '=', 'tindakan_medis.id_vitalsign')
            // ->leftjoin('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            ->select('tindakan_medis.*','users.name','antrians.Nomor_antrian','pendaftaran_pasiens.Nama_pasien')
            ->distinct();
        }
      
        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('tindakan_medis.id_tindakan_medis', 'like', "%$search%");
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
        Alert::success('Edit Data Pasien Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
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
        $obatIds = $request->get('id_obat');
        // dd($obatIds);
        $tindakanMedis = new tindakan_medis;
        $tindakanMedis->id_vitalsign =  $request->get('id_vitalsign');
        $tindakanMedis->jenis_tindakan =  $request->get('jenis_tindakan');
        $tindakanMedis->hasil_tindakan = $request->get('hasil_tindakan');
        $tindakanMedis->tanggal_tindakan =  $request->get('tanggal_tindakan');
        $tindakanMedis->id_dokter = $request->get('id_dokter');
        $tindakanMedis->created_by = Auth::user()->id;
        $tindakanMedis->save();

        foreach ($obatIds as $obatId) {
            $detailTindakanMedis = new detailtindakan;
            $detailTindakanMedis->id_obat = $obatId;
            $tindakanMedis->detailtindakan()->save($detailTindakanMedis);
        }
        Alert::success('Data tindak medis Pasien Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(tindakan_medis $tindakan_medis, $id)
    { 
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', Auth::user()->name )
        ->first();
        $tindakan_medis = DB::table('detail_tindakan_medis')
            ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
            ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            // ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
            ->select('users.id','users.name','tindakan_medis.*')
            ->where('tindakan_medis.id_tindakan_medis',$id)->first();
        $obat = DB::table('detail_tindakan_medis')
            // ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
            // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
            ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
            ->select('obats.*')
            ->where('detail_tindakan_medis.id_tindakan_medis',$id)->get();
        // dd($obat);
       
        $vitalSign = DB::table('vitalsign')
            ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
            ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            ->join('pendaftaran_pasiens', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('vitalsign.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name','pendaftaran_pasiens.*')
            ->where('vitalsign.id_vitalsign', $tindakan_medis->id_vitalsign)->first();
        return view('tindakan_medis.show', compact('userlogin','obat','tindakan_medis','vitalSign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tindakan_medis $tindakan_medis, $id)
    {
        $tindakan_medis = DB::table('tindakan_medis')
        ->join('detail_tindakan_medis', 'detail_tindakan_medis.id_tindakan_medis', '=', 'tindakan_medis.id_tindakan_medis')
        ->join('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->select('tindakan_medis.*','users.name')
        ->where('tindakan_medis.id_tindakan_medis', $id)->first();
        $AllObat = obat::all();
        $obat = DB::table('detail_tindakan_medis')
        ->leftjoin('tindakan_medis', 'tindakan_medis.id_tindakan_medis', '=', 'detail_tindakan_medis.id_tindakan_medis')
        // ->leftjoin('users', 'users.id', '=', 'tindakan_medis.id_dokter')
        ->leftJoin('obats', 'obats.id_obat', '=', 'detail_tindakan_medis.id_obat')
        ->select('obats.*')
        ->where('detail_tindakan_medis.id_tindakan_medis',$id)->get();
        // dd($obat); 

        // return view('pendaftaran_pasien.edit',compact('pendaftaran_pasien'));
        return view('tindakan_medis.edit',compact('AllObat','tindakan_medis','obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tindakan_medis $tindakan_medis, $id)
    {
        $obatIds = $request->get('id_obat');
        $tindakanMedis = tindakan_medis::find($id);
        $tindakanMedis->jenis_tindakan = $request->get('jenis_tindakan');
        $tindakanMedis->hasil_tindakan = $request->get('hasil_tindakan');
        $tindakanMedis->tanggal_tindakan = $request->get('tanggal_tindakan');
        // dd($tindakanMedis);
        $tindakanMedis->updated_by = Auth::user()->id;
        $tindakanMedis->update($request->all());

        detailtindakan::where('id_tindakan_medis', $id)
        ->whereNotIn('id_obat', $obatIds)
        ->delete();
        foreach ($obatIds as $obatId) {
            $detailTindakanMedis = detailtindakan::where('id_tindakan_medis', $id)
                ->where('id_obat', $obatId)
                ->first();
        
            if ($detailTindakanMedis) {
                $detailTindakanMedis->update(['id_obat' => $obatId]);
            } else {
                $detailTindakanMedis = new detailtindakan;
                $detailTindakanMedis->id_obat = $obatId;
                $tindakanMedis->detailtindakan()->save($detailTindakanMedis);
            }
        }
        
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return view('tindakan_medis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tindakan_medis $tindakan_medis, $id)
    {

        $antrian = detailtindakan::where('id_tindakan_medis',$id)->first();
        if ($antrian != null) {
            $antrian->delete();
        }
    
        $pendaftaranPasien = tindakan_medis::find($id);
        $pendaftaranPasien->delete();
        Alert::success('Hapus Data Pasien Telah Berhasil');
        return redirect()->route('tindakan_medis.index')
                        ->with('success','Product deleted successfully');
    }
    public function proses($id)
    {
        $usersDokter = DB::table('model_has_roles')
                    ->leftjoin('users', 'model_has_roles.model_id', '=', 'users.id')
                    ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    // ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
                    ->select('users.id','users.name')
                    ->where('roles.name', 'Dokter')->get();
        // dd($usersDokter);
        $obat = obat::all();
        $pendaftaran_pasien = DB::table('pendaftaran_pasiens')
                ->join('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
                ->join('vitalsign', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
                ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
                ->select('vitalsign.*','antrians.Nomor_antrian','antrians.id_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name')
                ->where('pendaftaran_pasiens.id', $id)->first();
        // dd($pendaftaran_pasien);
        return view('tindakan_medis.create',compact('usersDokter','pendaftaran_pasien','obat'));

        // return view('vital_sign.create');
    }
}
