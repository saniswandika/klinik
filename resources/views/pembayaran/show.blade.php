@extends('layouts.app')
@section('title', 'Detail Tindakan Medis Pasien')
@section('content')
        <div class="row p-3 d-flex justify-content-center">
            <div class="card card-primary card-outline col-xl-12 col-md-6 col-sm-6 p-3 " style="margin-right: 20px;">
                <div class="card-body box-profile ">
                    {{-- <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{asset('images/pp.png')}}"
                        alt="User profile picture">
                    </div> --}}
                    <h3 class="profile-username text-center">Detail Tindakan Medis</h3>

                    <ul class="list-group list-group-unbordered mb-3 center">
                        <table width="100%" height="100%" class="table border border-2"> 
                            <tr>
                                <td width="1px">Nomor Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->Nomor_antrian }}</td>
                            </tr>  
                            <tr>
                                <td width="1px">Nama Dokter</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->name }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Nama Pasien</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->Nama_pasien }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Alamat</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->Alamat }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Jenis Kelamin</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td width="1px">jenis Tindakan</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->jenis_tindakan }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Hasil Tindakan</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->hasil_tindakan }}</td>
                            </tr>
                            <tr>
                                <td width="1px">obat</td>
                                <td  width="1px">:</td>
                              
                                <td>
                                    @foreach ($obat as $itemObat)
                                        <p>{{ $itemObat->nama_obat }}</p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width="1px">Tanggal Tindakan</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->tanggal_tindakan }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Tanggal Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->tanggal_antrian }}</td>
                            </tr> 
                            <tr>
                                <td width="1px">Waktu Antrian</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->waktu_antrian }}</td>
                            </tr> 
                            <tr>
                                <td width="1px">Tanggal Pendaftaran</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->tanggal_pendaftaran }}</td>
                            </tr>
                            <tr>
                                <td width="1px">Tanggal Pembayaran</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->Tanggal_Pembayaran }}</td>
                            </tr>  
                            <tr>
                                <td width="1px">Total Pembayaran</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->total_pembayaran }}</td>
                            </tr> 
                            <tr>
                                <td width="1px">Metode Pembayaran</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->metode_pembayaran }}</td>
                            </tr> 
                            @if ($vitalSign->metode_pembayaran == 'Cashless')
                            <tr>
                                <td width="1px">Detail Cashless</td>
                                <td  width="1px">:</td>
                                <td>{{ $vitalSign->cashless_details }}</td>
                            </tr> 
                            @endif
                           
                                                   
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
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-default" type="button">Kembali</a>
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