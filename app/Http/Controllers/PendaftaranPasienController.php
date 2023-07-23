<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran_pasien;
use App\Models\antrian;
use App\Models\klinik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class PendaftaranPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $pendaftaranPasien = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id', $user_id)
        ->first();
        // dd($pendaftaranPasien);
        return view('pendaftaran_pasien.index',compact('pendaftaranPasien'));
    }
    public function getdata(Request $request)
    {
        $user_name = Auth::user()->name;
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', $user_name )
        ->first();
        // dd($userlogin->name);
        if ($userlogin->name != 'pasien') {
            $today = Carbon::today();
            $query = DB::table('pendaftaran_pasiens')
                ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_Anak')
                // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
                ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
                ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
                // ->where('pendaftaran_pasiens.created_by',$user_name)
                ->whereDate('pendaftaran_pasiens.created_at', '=', $today)
                ->distinct();
            
        // dd($today)
            // dd($query);
        }else{
            $query = DB::table('pendaftaran_pasiens')
            ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_Anak')
            // ->leftjoin('roles', 'roles.id', '=', 'rekomendasi_rekativasi_pbi_jks.tujuan_pbijk')
            ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian')
            ->where('pendaftaran_pasiens.created_by',$user_name)
            ->distinct();
        }
       
        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pendaftaran_pasiens.Nama_Anak', 'like', "%$search%");
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
        $user_name = Auth::user()->name;
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', $user_name)
        ->first();
        return view('pendaftaran_pasien.create',compact('userlogin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $getrole = DB::table('model_has_roles')
            ->select('model_has_roles.*')
            ->where('model_has_roles.model_id', Auth::user()->id)
            ->first();
        $dataBayiPosyandu = DB::table('data_bayi_posyandus')
            ->select('data_bayi_posyandus.*')
            ->where('data_bayi_posyandus.user_id', Auth::user()->id)
            ->first();
        // dd($dataBayiPosyandu);
        // dd($request->all());
        $pendaftaranPasien = new pendaftaran_pasien;
        $pendaftaranPasien->Nama_Anak = $request->get('Nama_Anak');
        $pendaftaranPasien->Alamat = $request->get('Alamat');
        $pendaftaranPasien->tanggal_pendaftaran = $request->get('tanggal_pendaftaran');
        $pendaftaranPasien->waktu_pendaftaran = $request->get('waktu_pendaftaran');
        $pendaftaranPasien->jenis_kelamin = $request->get('jenis_kelamin');
        $pendaftaranPasien->role_id = $getrole->role_id;
        $pendaftaranPasien->klinik_id = $request->get('klinik_id');
        // $pendaftaranPasien->klinik_id = $request->get('klinik_id');
        
        $pendaftaranPasien->id_data_bayi_posyandu = $dataBayiPosyandu->id;
        $pendaftaranPasien->user_id = $request->get('user_id');
        $pendaftaranPasien->created_by = Auth::user()->name;
        // dd($pendaftaranPasien);
        $pendaftaranPasien->save();
        
        $antrianterakhir = antrian::whereDate('created_at', Carbon::today())->max('Nomor_antrian');

        // Jika belum ada nomor antrian pada hari ini, mulai dari 1
        if (is_null($antrianterakhir)) {
            $antrianselanjutnya = 1;
        } else {
            $antrianselanjutnya = $antrianterakhir + 1;
        }
        
        // Simpan nomor antrian untuk pendaftaran baru
        $antrian = new antrian;
        $antrian->Nomor_antrian = $antrianselanjutnya;
        $antrian->tanggal_antrian = $request->get('tanggal_antrian');
        $antrian->waktu_antrian = $request->get('waktu_antrian');
        $antrian->id_pendafataran = $pendaftaranPasien->id;
        $antrian->save();
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return redirect()->route('pendaftaran_pasien.index');
        // return view('pendaftaran_pasien.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran_pasien = DB::table('pendaftaran_pasiens')
            ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_Anak')
            ->leftjoin('kliniks', 'kliniks.id', '=', 'pendaftaran_pasiens.klinik_id')
            ->leftjoin('data_bayi_posyandus', 'data_bayi_posyandus.Nama_Anak', '=', 'pendaftaran_pasiens.Nama_Anak')
            ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
            ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','kliniks.nama_posyandu','users.name','data_bayi_posyandus.*')
            ->where('pendaftaran_pasiens.id', $id)->first();
        // dd($pendaftaran_pasien);

        return view('pendaftaran_pasien.show',compact('pendaftaran_pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pendaftaran_pasien $pendaftaran_pasien)
    {
        $user_name = Auth::user()->name;
        $userlogin = DB::table('model_has_roles')
        // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
        ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.name', $user_name )
        ->first();
        $pendaftaran_pasien = DB::table('pendaftaran_pasiens')
        ->leftjoin('users', 'users.id', '=', 'pendaftaran_pasiens.Nama_Anak')
        ->leftjoin('kliniks', 'kliniks.id', '=', 'pendaftaran_pasiens.klinik_id')
        ->leftjoin('antrians', 'antrians.id_pendafataran', '=', 'pendaftaran_pasiens.id')
        ->select('pendaftaran_pasiens.*','antrians.Nomor_antrian','antrians.tanggal_antrian','antrians.waktu_antrian','kliniks.nama_klinik','users.name')
        ->where('pendaftaran_pasiens.id', $pendaftaran_pasien->id)->first();

        return view('pendaftaran_pasien.edit',compact('userlogin','pendaftaran_pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pendaftaran_pasien $pendaftaran_pasien)
    {
        $getrole = DB::table('model_has_roles')
        ->select('model_has_roles.*')
        ->where('model_has_roles.model_id', Auth::user()->id)
        ->first();
        // dd($query);
        // dd($request->all());
        $pendaftaranPasien = pendaftaran_pasien::find($pendaftaran_pasien->id);
        $pendaftaranPasien->Nama_Anak = $request->get('Nama_Anak');
        $pendaftaranPasien->Alamat = $request->get('Alamat');
        $pendaftaranPasien->tanggal_pendaftaran = $request->get('tanggal_pendaftaran');
        $pendaftaranPasien->waktu_pendaftaran = $request->get('waktu_pendaftaran');
        $pendaftaranPasien->jenis_kelamin = $request->get('jenis_kelamin');
        $pendaftaranPasien->role_id = $getrole->role_id;
        $pendaftaranPasien->klinik_id = $request->get('klinik_id');
        // $pendaftaranPasien->status = $request->get('status');
        $pendaftaranPasien->user_id = $request->get('user_id');
        $pendaftaranPasien->updated_by = Auth::user()->name;
        //  dd($pendaftaranPasien);
        $pendaftaranPasien->save();
       
        
        $antrianterakhir = antrian::whereDate('created_at', Carbon::today())->max('Nomor_antrian');

        // Jika belum ada nomor antrian pada hari ini, mulai dari 1
        // if (is_null($antrianterakhir)) {
        //     $antrianselanjutnya = 1;
        // } else {
        //     $antrianselanjutnya = $antrianterakhir + 1;
        // }

        // Simpan nomor antrian untuk pendaftaran baru
        $antrian = antrian::where('id_pendafataran',$pendaftaran_pasien->id)->first();
        // dd($pendaftaranPasien->id);
        $antrian->Nomor_antrian =$request->get('Nomor_antrian');
        $antrian->tanggal_antrian = $request->get('tanggal_antrian');
        $antrian->waktu_antrian = $request->get('waktu_antrian');
        $antrian->id_pendafataran = $pendaftaranPasien->id;
        $antrian->save();

        Alert::success('Edit Data Pasien Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pendaftaran_pasien $pendaftaran_pasien)
    {

        $antrian = antrian::where('id_pendafataran',$pendaftaran_pasien->id)->first();
        if ($antrian != null) {
            $antrian->delete();
        }
    
        $pendaftaranPasien = pendaftaran_pasien::find($pendaftaran_pasien->id);
        $pendaftaranPasien->delete();
        Alert::success('Hapus Data Pasien Telah Berhasil');
        return redirect()->route('pendaftaran_pasien.index')
                        ->with('success','Product deleted successfully');
    }
    public function prosesPendaftaranPasien($id)
    {
            // $users = User::find($id);
            // dd($users);
            $user_name = Auth::user()->name;
            $userlogin = DB::table('model_has_roles')
            // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('roles.name')
            ->where('users.name', $user_name)
            ->first();

            $userlogin = DB::table('model_has_roles')
            // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            // ->leftJoin('users as usr_name', 'usr_name.name', '=', 'data_bayi_posyandus.Nama_Anak')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('roles.name')
            ->where('users.name', $user_name)
            ->first();
            // dd($userlogin);


            return view('pendaftaran_pasien.create',compact('userlogin'));
    }
    
}
