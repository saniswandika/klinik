<?php

namespace App\Http\Controllers;

use App\Models\vitalSign;
use App\Models\antrian;
use App\Models\pendaftaran_pasien;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // dd($pendaftaranPasien);
    //    $product = vitalSign::withTrashed()->find(3);
       $products = vitalSign::withTrashed()->get();
    //    dd($products);
       return view('vital_sign.index');
    }
    public function getdatavitalsign(Request $request)
    {
        $user_name = Auth::user()->name;
        $today = Carbon::today();
        $query = DB::table('pendaftaran_pasiens')
            ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
            // ->where('pendaftaran_pasiens.created_by',$user_name)
            ->whereDate('pendaftaran_pasiens.created_at', '=', $today)
            ->distinct();
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
    public function datavitalsign(Request $request)
    {
        $user_name = Auth::user()->name;
      
        $user_wilayah = DB::table('model_has_roles')
            // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('roles.name')
            ->where('users.name', $user_name )
            ->first();
            // dd($user_wilayah->name);
        if ($user_wilayah->name == 'pasien') {
            $query = DB::table('vitalsign')
            ->leftJoin('antrians', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            // ->leftJoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            ->select('pendaftaran_pasiens.*', 'antrians.Nomor_antrian','vitalsign.*')
            ->where('pendaftaran_pasiens.created_by',$user_name)
            ->distinct();
        }elseif($user_wilayah->name == 'perawat'){
        
            $query = DB::table('vitalsign')
            ->leftjoin('users', 'users.id', '=', 'vitalsign.id_perawat')
            ->leftjoin('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            // ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'vitalsign.id')
            ->select('vitalsign.*','antrians.*','users.*')
            ->where('vitalsign.deleted_at', null)
            ->where('vitalsign.created_by',Auth::user()->id)
            ->orderBy('Nomor_antrian', 'asc');
        }else {
        $today = Carbon::today();

            $query = DB::table('vitalsign')
            ->leftJoin('antrians', 'vitalsign.id_antrian', '=', 'antrians.id_antrian')
            ->leftJoin('pendaftaran_pasiens', 'pendaftaran_pasiens.id', '=', 'antrians.id_pendafataran')
            // ->leftJoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
            ->select('pendaftaran_pasiens.*', 'antrians.Nomor_antrian','vitalsign.*')
            // ->where('pendaftaran_pasiens.created_by',$user_name)
            ->whereDate('pendaftaran_pasiens.created_at', '=', $today)
            ->distinct();
        }
        // dd($query);
        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('vitalsign.id_antrian', 'like', "%$search%");
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


        return view('vital_sign.create');
    }
    public function hapusdata($id)
    {
        // dd($rekomendasi_bantuan_pendidikans);
        $data2 = DB::table('vitalsign as w')->select(
            'w.*',
            // 'w.status_wilayah',
        )
        ->where('w.id_vitalsign', $id)->first();
        // dd($data2);
        $data = [
            'data' => $data2
            // 'data' => $data2
          ];
        return response()->json($data);
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rasi_oksigen' => 'required|numeric|min:50|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pendaftaranPasien = new vitalSign();
        $pendaftaranPasien->id_antrian = $request->get('id_antrian');
        $pendaftaranPasien->id_perawat = $request->get('id_perawat');
        $pendaftaranPasien->tekanan_darah = $request->get('tekanan_darah');
        $pendaftaranPasien->suhu_tubuh = $request->get('suhu_tubuh');
        $pendaftaranPasien->laju_respirasi = $request->get('laju_respirasi');
        $pendaftaranPasien->rasi_oksigen = $request->get('rasi_oksigen');
        // $pendaftaranPasien->role_id = $getrole->role_id;
        $pendaftaranPasien->created_by = Auth::user()->id;
        $pendaftaranPasien->pulsu = $request->get('pulsu');
        $pendaftaranPasien->save();
       
    
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return view('vital_sign.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(vitalSign $vitalSign, $id)
    {
        $vitalSign = DB::table('vitalsign')
            ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
            ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
            ->join('pendaftaran_pasiens', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('vitalsign.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','users.name','pendaftaran_pasiens.*')
            ->where('vitalsign.id_vitalsign', $id)->first();
            //   dd($vitalSign);
        return view('vital_sign.show',compact('vitalSign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vitalSign $vitalSign, $id)
    {
        $pendaftaran_pasien = DB::table('vitalsign')
        ->join('antrians', 'antrians.id_antrian', '=', 'vitalsign.id_antrian')
        ->join('users', 'users.id', '=', 'vitalsign.id_perawat')
        ->select('vitalsign.*','antrians.*','users.name')
        ->where('vitalsign.id_vitalsign', $id)->first();
        // dd($pendaftaran_pasien); 

        // return view('pendaftaran_pasien.edit',compact('pendaftaran_pasien'));
        return view('vital_sign.edit',compact('pendaftaran_pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_vitalsign)
    {
        // dd($request->all());
        // $vital_sign = vitalSign::find($id_vitalsign);
        $vital_sign = vitalSign::where('id_vitalsign',$id_vitalsign)->first();
        $vital_sign->id_antrian = $request->get('id_antrian');
        $vital_sign->id_perawat = $request->get('id_perawat');
        $vital_sign->tekanan_darah = $request->get('tekanan_darah');
        $vital_sign->suhu_tubuh = $request->get('suhu_tubuh');
        $vital_sign->laju_respirasi = $request->get('laju_respirasi');
        $vital_sign->updated_by = Auth::user()->id;
        // $vital_sign->user_id = $request->get('user_id');
    //    dd($vital_sign);

        $vital_sign->update($request->all());
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return view('vital_sign.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
        // $product = vitalSign::find($i);
        // $pendaftaranPasien = vitalSign::find($id);
        $pendaftaranPasien = vitalSign::where('id_vitalsign',$id)->first();
        // dd($pendaftaranPasien);
        $pendaftaranPasien->delete();
        Alert::success('Hapus Data Pasien Telah Berhasil');
        return redirect()->route('vital_sign.index');
    }
    public function proses($id)
    {
        $usersPerawat = DB::table('model_has_roles')
        ->leftjoin('users', 'model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        // ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->select('users.id','users.name')
        ->where('roles.name', 'perawat')->get();
        $pendaftaran_pasien = DB::table('pendaftaran_pasiens')
        ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_pasien')
        ->leftjoin('kliniks', 'kliniks.id', '=', 'pendaftaran_pasiens.klinik_id')
        ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian','antrians.id_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','kliniks.nama_klinik','users.name')
        ->where('pendaftaran_pasiens.id', $id)->first();

        // return view('pendaftaran_pasien.edit',compact('pendaftaran_pasien'));
        return view('vital_sign.create',compact('usersPerawat','pendaftaran_pasien'));
     
        // return view('vital_sign.create');
    }
}
