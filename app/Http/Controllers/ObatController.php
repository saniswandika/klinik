<?php

namespace App\Http\Controllers;

use App\Models\obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // dd($pendaftaranPasien);
        return view('obat.index');
    }
    public function getdataobat(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('obats')
            ->select('obats.*')
            ->distinct();
        // dd($query);
        if ($request->has('search')) {
            // dd($query);
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('obats.nama_obat', 'like', "%$search%");
            });
        }
        $total_filtered_items = $query->count();
        $start = $request->start;
        $length = $request->length;
        $query->offset($start)->limit($length);
        $data = $query->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => obat::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obat = new obat;
        $obat->nama_obat = $request->get('nama_obat');
        $obat->harga_obat = $request->get('harga_obat');
        $obat->save();
        Alert::success('tamabah Data Obat Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(obat $obat)
    {
        return view('obat.show',compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(obat $obat)
    {
        return view('obat.edit',compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, obat $obat)
    {
        $obat = obat::find($obat->id_obat);
        // dd($obat);
        $obat->update($request->all());

        Alert::success('Edit Data Obat Berhasil Disimpan');
        return redirect()->back()->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(obat $obat)
    {
        $obat->delete();

        Alert::success('hapus Data Obat Berhasil');
        return redirect()->back()->with('success','Product updated successfully');
    }
}
