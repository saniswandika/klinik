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
                Tambah Data vital sign pasien
            </h3>
            <a href="{{ route('vital_sign.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>

        {!! Form::open([
            'route' => 'vital_sign.store',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
        ]) !!}
       @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body shadow-lg">
   
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">no antri pasien </label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $pendaftaran_pasien->Nomor_antrian }}"  readonly />
                    {{-- <input type="text" id="form6Example3" class="form-control" value="{{ Auth::user()->name; }}"  readonly/> --}}
                <input type="hidden" value="{{ $pendaftaran_pasien->id_antrian }}"  name="id_antrian">
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nama Perawat</label>
                    <select class="form-control dokter" name="id_perawat">
                        @foreach ($usersPerawat as $itemUser)
                            <option value="{{ $itemUser->id }}">{{ $itemUser->name }}</option>
                        @endforeach
                    </select>
                </div>
           
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">tekanan_darah</label>
                      <select class="form-select" aria-label="Default select example" name="tekanan_darah">
                        {{-- @foreach ($roles as $role ) --}}
                          <option selected>Pilih Tekanan Darah ...</option>
                          <option value="Normal">Normal</option>
                          <option value="Darah Rendah">Darah Rendah</option>
                          <option value="Darah Tinggi">Darah Tinggi</option>
                        {{-- @endforeach --}}
                    </select> 
                      {{-- <input type="text" id="form6Example1" class="form-control" name="tekanan_darah"/> --}}
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example1">suhu_tubuh</label>
                        <input type="text" id="form6Example1" class="form-control" name="suhu_tubuh"/>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">laju_respirasi</label>
                        <input type="text" id="form6Example1" class="form-control" name="laju_respirasi"/>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-outline">
                          <label class="form-label" for="form6Example1">pulsu</label>
                          <input type="text" id="form6Example1" class="form-control" name="pulsu"/>
                        </div>
                    </div>
                  </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Rasi Oksigen</label>
                    <div class="input-group">
                        <input type="number" name="rasi_oksigen" value="{{ old('rasi_oksigen') }}" min="50" max="100" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                <!-- Text input -->
            <div class="card-footer">
                <div class="d-grid gap-2">
                    
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ route('vital_sign.index') }}" class="btn btn-default" type="button">Batal</a>
              </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
@endsection
