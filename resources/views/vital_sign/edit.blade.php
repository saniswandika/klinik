{{-- @extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back </a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.update',$product->id) }}" method="POST">
    	@csrf
        @method('PUT')

         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>

@endsection --}}
@extends('layouts.app')

@section('title', 'Tambah data vital sign pasien')

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
                Edit data vital sign pasien
            </h3>
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>

        {!! Form::model($pendaftaran_pasien, ['method' => 'POST','route' => ['vitalsign.update', $pendaftaran_pasien->id_vitalsign]]) !!}
            <div class="card-body shadow-lg">
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Role Pasien</label>
                    <input type="text" id="form6Example3" class="form-control" name="role_id" />
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nomer antrian</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $pendaftaran_pasien->Nomor_antrian }}" readonly/>
                    <input type="hidden" value="{{ $pendaftaran_pasien->id_antrian }}" name="id_antrian">
                </div>
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Klinik</label>
                    <input type="text" id="form6Example3" class="form-control" value="kllinik cahaya abadi" readonly />
                            <input type="hidden" value="1" name="Klinik_id">
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nama Perawat</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $pendaftaran_pasien->name }}"  readonly/>
                    <input type="hidden" value="{{ $pendaftaran_pasien->id_perawat }}" name="id_perawat">
                </div>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Nik Balita</label>
                            <input type="text" id="form6Example3" class="form-control" name="NIK"  />
                            {{-- <input type="text" id="form6Example3" class="form-control" name="NIK" value="{{ $pendaftaran_pasien->name }}" /> --}}
                          
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->tekanan_darah }}" name="tekanan_darah"/> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Nama_Anak</label>
                            <input type="text" id="form6Example1" class="form-control" name="Nama_Anak"/>
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Nama_Anak }}" name="Nama_Anak"/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">tangggal Lahir</label>
                            <input type="date" id="form6Example3" class="form-control" name="tgl_lahir"  />
                            {{-- <input type="text" id="form6Example3" class="form-control" name="NIK" value="{{ $pendaftaran_pasien->name }}" /> --}}
                          
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->tekanan_darah }}" name="tekanan_darah"/> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Umur_Tahun</label>
                            <input type="Number" id="form6Example1" class="form-control" name="Umur_Tahun"/>
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Umur_Tahun }}" name="Nama_Anak"/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Umur_bulan</label>
                            <input type="number" id="form6Example3" class="form-control" name="Umur_bulan"  />
                            {{-- <input type="text" id="form6Example3" class="form-control" name="NIK" value="{{ $pendaftaran_pasien->name }}" /> --}}
                          
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->tekanan_darah }}" name="tekanan_darah"/> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">jenis_kelamin</label>
                            {{-- <input type="Number" id="form6Example1" class="form-control" name="jenis_kelamin"/> --}}
                            <select class="form-control dokter" name="jenis_kelamin">
                                {{-- @foreach ($usersPerawat as $itemUser) --}}
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                {{-- @endforeach --}}
                            </select>
                            {{-- <select class="form-control dokter" name="id_perawat">
                                @foreach ($usersPerawat as $itemUser)
                                    <option value="{{ $itemUser->id }}">{{ $itemUser->name }}</option>
                                @endforeach
                            </select> --}}
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Umur_Tahun }}" name="Nama_Anak"/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Nama_Ortu</label>
                            <input type="text" id="form6Example3" class="form-control" name="Nama_Ortu"  />
                            {{-- <input type="text" id="form6Example3" class="form-control" name="NIK" value="{{ $pendaftaran_pasien->name }}" /> --}}
                          
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->tekanan_darah }}" name="tekanan_darah"/> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Nik_Ortu</label>
                            <input type="Number" id="form6Example1" class="form-control" name="Nik_Ortu"/>
                         
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Umur_Tahun }}" name="Nama_Anak"/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Pkm</label>
                            <input type="text" id="form6Example3" class="form-control" name="Pkm"  />
                            {{-- <input type="text" id="form6Example3" class="form-control" name="NIK" value="{{ $pendaftaran_pasien->name }}" /> --}}
                          
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->tekanan_darah }}" name="tekanan_darah"/> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Kelurahan</label>
                            <input type="text" id="form6Example1" class="form-control" name="Kelurahan"/>
                         
                            {{-- <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Umur_Tahun }}" name="Nama_Anak"/> --}}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Text input -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">pulsu</label>
                                <input type="text" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->pulsu }}" name="pulsu"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">laju_respirasi</label>
                                <input type="text" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->laju_respirasi }}" name="laju_respirasi"/>
                            </div>
                        </div>
                    </div>
                    <!-- Text input -->
                <div class="card-footer">

                    <div class="d-grid gap-2">
                        
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a href="{{ URL::previous() }}" class="btn btn-default" type="button">Batal</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{-- 	
        NAMA ANAK	
        TGL LAHIR	
        Umur Tahun	
        Umur Bulan	
        JENIS KELAMIN	
        NAMA ORTU	
        NIK ORTU	
        NO.HP ORTU	
        PKM	KEL	
        POSYANDU	
        RT	
        RW	
        ALAMAT	
        TGL UKUR	
        TINGGI	
        CARA UKUR	
        BERAT	
        LILA	
        LINGKAR UKUR	
        STATUS GIZI --}}
  
@endsection
