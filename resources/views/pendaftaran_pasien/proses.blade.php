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
                Tambah Data Pasien
            </h3>
            {{-- <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a> --}}

        </div>

        {!! Form::open([
            'route' => 'pendaftaran_pasien.store',
            'method' => 'POST',
            'enctype' => 'multipart/form-data',
        ]) !!}

        <div class="card-body shadow-lg">
            {{-- <div class="form-outline mb-4">
                <label class="form-label" for="form6Example3">Role Pasien</label>
                <input type="text" id="form6Example3" class="form-control" name="role_id" />
            </div> --}}
            <div class="form-outline mb-4">
                <label class="form-label" for="form6Example3">Klinik</label>
                <input type="text" id="form6Example3" class="form-control" value="kllinik cahaya abadi" readonly />
                        <input type="hidden" value="1" name="Klinik_id">
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form6Example3">Nama User</label>
                <input type="text" id="form6Example3" class="form-control" value="{{ Auth::user()->name; }}"  readonly/>
                <input type="hidden" value="{{ Auth::user()->id; }}" name="user_id">
            </div>
           
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline">
                      <label class="form-label" for="form6Example1">Nama Pasien</label>
                      <input type="text" id="form6Example1" class="form-control" name="Nama_pasien"/>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="form6Example2">Jenis Kelamin</label>
                        <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                            <option selected>Pilih Jenis Kelamin...</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                            {{-- <option value="3">Three</option> --}}
                          </select>
                     
                    </div>
                  </div>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example7">Alamat Pasien</label>
                  <textarea class="form-control" id="form6Example7" rows="4" name="Alamat"></textarea>
                  
                </div>
                <!-- Text input -->
                <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Tanggal Pendaftaran</label>
                        <input type="date" id="form6Example1" class="form-control" name="tanggal_pendaftaran"/>
                      </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Waktu Pendaftaran</label>
                            <input type="time" id="form6Example1" class="form-control" name="waktu_pendaftaran"/>
                          </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                      <div class="form-outline">
                        <label class="form-label" for="form6Example1">Tanggal Antrian</label>
                        <input type="date" id="form6Example1" class="form-control" name="tanggal_antrian"/>
                      </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Waktu Antrian</label>
                            <input type="time" id="form6Example1" class="form-control" name="waktu_antrian"/>
                          </div>
                    </div>
                </div>
              
                <!-- Text input -->

                
            <div class="card-footer">
                {{-- <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button class="btn btn-primary" id="btn-submit" type="submit">
                    <i class="fa fa-check"></i> Submit
                </button> --}}
                <div class="d-grid gap-2">
                    
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default" type="button">Batal</a>
              </div>
            </div>



            {!! Form::close() !!}

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
@endsection
