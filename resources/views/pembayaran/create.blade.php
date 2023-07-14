@extends('layouts.app')

@section('title', 'Tambah Data Pembayaran')

<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
    }

    .card-header a {
        margin-left: 10px;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h3>
              
            </h3>
            {{-- <a href="{{ route('pembayaran.index')}}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a> --}}

        </div>
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
                            <td>{{ $data_pasien->Nomor_antrian }}</td>
                        </tr>  
                        <tr>
                            <td width="1px">Nama Dokter</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->name }}</td>
                        </tr>
                        <tr>
                            <td width="1px">Nama Pasien</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->Nama_pasien }}</td>
                        </tr>
                        <tr>
                            <td width="1px">Alamat</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->Alamat }}</td>
                        </tr>
                        <tr>
                            <td width="1px">Jenis Kelamin</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td width="1px">jenis Tindakan</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->jenis_tindakan }}</td>
                        </tr>
                        <tr>
                            <td width="1px">Hasil Tindakan</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->hasil_tindakan }}</td>
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
                            <td>{{ $data_pasien->tanggal_tindakan }}</td>
                        </tr>
                        <tr>
                            <td width="1px">Tanggal Antrian</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->tanggal_antrian }}</td>
                        </tr> 
                        <tr>
                            <td width="1px">Waktu Antrian</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->waktu_antrian }}</td>
                        </tr> 
                        <tr>
                            <td width="1px">Tanggal Pendaftaran</td>
                            <td  width="1px">:</td>
                            <td>{{ $data_pasien->tanggal_pendaftaran }}</td>
                        </tr> 
                                               
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
            </div>
        </div>
        {!! Form::open([
            'route' => 'pembayaran.store',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
        ]) !!}

        <div class="card-body shadow-lg">
            {{-- <div class="form-outline mb-4">
                <label class="form-label" for="form6Example3">Role Pasien</label>
                <input type="text" id="form6Example3" class="form-control" name="role_id" />
            </div> --}}
            <h3>
                Proses Data Pembayaran
            </h3>
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">kode Detail tindakan Medis</label>
                      <input type="text" id="form6Example1" class="form-control" value="{{$tindakan_medis->id }}" name="id_detail_tindakan_medis" readonly/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">tanggal pembayaran</label>
                        <input type="Date" id="form6Example1" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="tanggal_pembayaran"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Total Pembayaran</label>
                            <input type="text" id="form6Example1" class="form-control" value="Rp {{ number_format($totalHargaObat, 0, ',', '.') }}" name="total_pembayaran" readonly/>
                          </div>
                      </div>
                      <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example2">Metode Pembayaran</label>
                            <select class="form-select" aria-label="Default select example" id="metode_pembayaran" name="metode_pembayaran">
                                <option selected>Pilih Metode Pembayaran...</option>
                                <option value="Cashless">Cashless</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="cashless-details" style="display: none; margin-top:2%;">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example3">Cashless Details</label>
                                <select class="form-select" aria-label="Default select example" id="cashless_details" name="cashless_details">
                                    <option selected>Pilih Cashless Details...</option>
                                    <option value="Kartu Kredit">Kartu Kredit</option>
                                    <option value="E-wallet">E-wallet</option>
                                    <option value="Debit">Debit</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div id="barcode"></div>
            <div class="card-footer">
                {{-- <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button class="btn btn-primary" id="btn-submit" type="submit">
                    <i class="fa fa-check"></i> Submit
                </button> --}}
                <div class="d-grid gap-2">
                    
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-default" type="button">Batal</a>
              </div>
            </div>



            {!! Form::close() !!}

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/jsbarcode.min.js"></script>
    <script>
        var metodePembayaranDropdown = document.getElementById("metode_pembayaran");
        var cashlessDetailsSection = document.getElementById("cashless-details");
    
        metodePembayaranDropdown.addEventListener("change", function() {
            if (this.value === "Cashless") {
                cashlessDetailsSection.style.display = "block";
            } else {
                cashlessDetailsSection.style.display = "none";
            }
        });
    </script>
    {{-- <script>
        // Fungsi untuk menampilkan barcode berdasarkan nilai yang diberikan
        function showBarcode(barcodeValue) {
            JsBarcode("#barcodeContainer", barcodeValue);
        }
        
        // Event listener untuk memantau perubahan pada dropdown metode pembayaran
        document.getElementById('metode_pembayaran').addEventListener('change', function() {
            var metodePembayaran = this.value;
            
            // Jika metode pembayaran adalah cashless, tampilkan barcode
            if (metodePembayaran === 'Cashless') {
                var accountNumber = "Nomor Rekening Anda";
                showBarcode(accountNumber);
            } else {
                // Jika metode pembayaran bukan cashless, sembunyikan barcode
                document.getElementById('barcodeContainer').innerHTML = '';
            }
        });
    </script> --}}
  
@endsection
