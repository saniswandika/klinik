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

@section('title', 'Tambah Pasien')

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
                Edit Data Pasien
            </h3>
            @if($userlogin->name == 'pasien')
            <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            @elseif($userlogin->name == 'perawat')
            <a href="{{ route('vital_sign.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            @elseif($userlogin->name == 'Dokter')
            <a href="{{ route('tindakan_medis.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            @endif

        </div>

        {!! Form::model($pendaftaran_pasien, ['method' => 'PATCH','route' => ['pendaftaran_pasien.update', $pendaftaran_pasien->id]]) !!}
            <div class="card-body shadow-lg">
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Role Pasien</label>
                    <input type="text" id="form6Example3" class="form-control" name="role_id" />
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nomer antrian</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $pendaftaran_pasien->Nomor_antrian }}" name="Nomor_antrian"  />
                    {{-- <input type="hidden" value="{{ $pendaftaran_pasien->Nomor_antrian }}" > --}}
                </div>
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Klinik</label>
                    <input type="text" id="form6Example3" class="form-control" value="kllinik cahaya abadi" readonly />
                            <input type="hidden" value="1" name="Klinik_id">
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nama User</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ Auth::user()->name; }}"  readonly/>
                    <input type="hidden" value="{{ $pendaftaran_pasien->user_id }}" name="user_id">
                </div>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Nama Pasien</label>
                            <input type="text" id="form6Example1" class="form-control"  value="{{ $pendaftaran_pasien->Nama_pasien }}" name="Nama_pasien"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example2">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                    <option value="{{ $pendaftaran_pasien->jenis_kelamin }}" selected>{{ $pendaftaran_pasien->jenis_kelamin }}</option>
                                    @if ($pendaftaran_pasien->jenis_kelamin == 'Laki-Laki' )
                                     <option value="Perempuan">Perempuan</option>
                                    @else
                                     <option value="Laki-Laki">Laki-Laki</option>
                                    @endif
                                    {{-- <option value="3">Three</option> --}}
                                </select>
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form6Example7">Alamat Pasien</label>
                    <textarea class="form-control" id="form6Example7" rows="4"  name="Alamat">{{ $pendaftaran_pasien->Alamat }}</textarea>
                    
                    </div>
                    <!-- Text input -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Tanggal Pendaftaran</label>
                                <input type="date" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->tanggal_pendaftaran }}" name="tanggal_pendaftaran"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Waktu Pendaftaran</label>
                                <input type="time" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->waktu_pendaftaran }}" name="waktu_pendaftaran"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Tanggal Antrian</label>
                                <input type="date" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->tanggal_antrian }}" name="tanggal_antrian"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Waktu Antrian</label>
                                <input type="time" id="form6Example1" class="form-control" value="{{ $pendaftaran_pasien->waktu_antrian }}" name="waktu_antrian"/>
                            </div>
                        </div>
                    </div>
                
                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form6Example3">Status Pasien</label>
                        {{-- <input type="text" id="form6Example3" class="form-control" value="{{ $pendaftaran_pasien->status }}" name="status" /> --}}
                    </div>
                <div class="card-footer">
                    {{-- <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default">
                        <i class="fa fa-times"></i> Batal
                    </a>
                    <button class="btn btn-primary" id="btn-submit" type="submit">
                        <i class="fa fa-check"></i> Submit
                    </button> --}}
                    <div class="d-grid gap-2">
                        
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        @if($userlogin->name == 'pasien')
                            <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default" type="button">Batal</a>
                        @elseif($userlogin->name == 'perawat')
                            <a href="{{ route('vital_sign.index') }}" class="btn btn-default" type="button">Batal</a>
                        @elseif($userlogin->name == 'Dokter')
                            <a href="{{ route('tindakan_medis.index') }}" class="btn btn-default" type="button">Batal</a>
                        @endif
                        {{-- <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default" type="button">Batal</a> --}}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
@endsection
