@extends('layouts.app')
@section('title', 'Detail Pasien')
@section('content')
        <div class="row p-3 d-flex justify-content-center">
            <div class="card card-primary card-outline col-xl-12 col-md-6 col-sm-6 p-3 " style="margin-right: 20px;">
                <div class="card-body box-profile ">
                    {{-- <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{asset('images/pp.png')}}"
                        alt="User profile picture">
                    </div> --}}
                    <h3 class="profile-username text-center">Detail Pasien</h3>

                    <ul class="list-group list-group-unbordered mb-3 center">
                        <table width="100%" height="100%" class="table border border-2">
                            {{-- <tr>
                                <td width="1px">Nama Klinik</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->nama_klinik }}</td>
                            </tr>   --}}
                            <tr>
                                <td width="1px">Nama Pasien</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->Nama_pasien }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Alamat</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->Alamat }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Tanggal Pendaftaran</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->tanggal_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Jenis Kelamin</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->jenis_kelamin }}</td>
                            </tr>
                            
                            <tr>
                                <td width="1px">Nomor Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->Nomor_antrian }}</td>
                            </tr>  
                            <tr>
                                <td width="1px">Tanggal Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->tanggal_antrian }}</td>
                            </tr> 
                            <tr>
                                <td width="1px">Waktu Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->waktu_antrian }}</td>
                            </tr>  
                            {{-- <tr>
                                <td width="1px">status</td>
                                <td  width="1px">:</td>
                                <td>{{ $pendaftaran_pasien->status }}</td>
                            </tr>                                    --}}
                        </table>

                        {{-- @foreach($akses_user as $value) --}}
                            {{-- <li class="list-group-item"> --}}
                                {{-- @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <li class="list-group-item">{{ $v->name }},</li>
                                    @endforeach
                                @endif --}}
                            {{-- </li> --}}
                        {{-- @endforeach --}}
                 
                    </ul>
                    <ul class="list-group list-group-unbordered mb-3 center">
                        <a class="btn btn-primary" href="{{ route('pendaftaran_pasien.index') }}"> kembali</a>
                    </ul>
                </div>
            </div>
        </div>

{{-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div> --}}
@endsection