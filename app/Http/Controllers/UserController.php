<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use App\Exports\UsersExport;
use App\Imports\DtkssImport;
use App\Models\data_bayi_posyandu;
// use App\Models\Event;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $jadwals = Event::all();
        $data = User::orderBy('id', 'DESC')->paginate(5);

        $roles = DB::table('roles')->get();
        // dd($roles);
        // $roles = Role::pluck('name','name')->all();
        return view('users.index', compact('data', 'roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //= Event::all();
        $roles = DB::table('roles')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'alamat' => 'required',
            'jenis_kelamin' => 'required',
            // 'no_telepon' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        // dd($request->all());
        
        $input['email'] = $request->input('email');

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if ($user) {
            Alert::success('Tambah Data Pasien Berhasil Disimpan');
            return redirect()->back()
                ->with('masuk', 'User created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        Alert::success('Tambah Data Pasien Berhasil Disimpan');
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    //     public function export() 
    //     {
    //         return Excel::download(new UsersExport, 'users.xlsx');
    //     }
    //   /**
    //     * @return \Illuminate\Support\Collection
    //     */
    //     public function import(Request $request) 
    //     {
    //         if ($request->file('file')) {
    //             $data = Excel::import(new DtkssImport(), request()->file('file'));
    //             // dd($data);
    //             return redirect()->route('Dtks.index');
    //         }

    //     }

    public function get_users_by_role($id_role)
    {
        $users_role = DB::table('wilayahs')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.id', $id_role)
            ->where('wilayahs.status_wilayah', '1')
            ->get();
        return $users_role;
    }
    public function Registrasi(Request $request)
    {
        $this->validate($request, [
            'Kelurahan' => 'required',
            'Pkm' => 'required',
            'Alamat' => 'required',
            'jenis_kelamin' => 'required',
            'Nik_bayi' => 'required', // Unique in data_bayi_posyandu table
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',// Use "confirmed" validation rule for password confirmation
            'roles' => 'required',
            'Nama_Anak' => 'required',
            'Tgl_Lahir' => 'required',
            'Umur_bulan' => 'required',
            'Umur_Tahun' => 'required',
            'Nik_Ortu' => 'required',
            'Nama_Ortu' => 'required',
            'No_hp_Ortu' => 'required',
            'Posyandu' => 'required' // Assuming this field is for the Posyandu name
        ]);

        $input['email'] = $request->input('email');
        $input['jenis_kelamin'] = $request->input('jenis_kelamin');
        $input['name'] = $request->input('Nama_Anak');
        $input['password'] = Hash::make($request->input('password'));

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $dataBayi = $request->only([
            'Nama_Anak', 'Nik_bayi', 'Tgl_Lahir', 'Umur_bulan', 'Umur_Tahun',
            'Nik_Ortu', 'Nama_Ortu', 'No_hp_Ortu', 'Alamat', 'Pkm', 'Kelurahan',
            'Rw', 'Rt', 'Posyandu', 'jenis_kelamin'
        ]);
        $dataBayi['user_id'] = $user->id;
        data_bayi_posyandu::create($dataBayi);

        if ($user) {
            Alert::success('Tambah Data Pasien Berhasil Disimpan');
            return redirect()->back()
                ->with('masuk', 'User created successfully');
        }
    }
}
