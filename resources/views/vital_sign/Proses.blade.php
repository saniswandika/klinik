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
                Proses Data Prediksi Data Bayi
            </h3>
            <a href="{{ route('vital_sign.index') }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>

        {!! Form::model($pendaftaran_pasien, ['method' => 'POST','route' => ['prosesPrediksi', $pendaftaran_pasien->id_byp]]) !!}
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
                        <label class="form-label" for="form6Example1">Cara_Ukur</label>
                        <select class="form-control dokter" name="Cara_Ukur">
                            {{-- @foreach ($usersPerawat as $itemUser) --}}
                                <option value="BERDIRI" selected>Pilih Cara Ukur ...</option>
                                <option value="BERDIRI">BERDIRI</option>
                                <option value="TERLENTANG">TERLENTANG</option>
                            {{-- @endforeach --}}
                        </select>
                        {{-- <input type="text" id="form6Example1" class="form-control" name="Cara_Ukur"/> --}}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Tgl_Ukur</label>
                            <input type="date" id="form6Example1" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="Tgl_Ukur" />

                        </div>
                    </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">tinggi_badan</label>
                                <input type="number" id="form6Example1" class="form-control" name="tinggi_badan"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Berat_Badan</label>
                                <input type="number" id="form6Example1" class="form-control" name="Berat_Badan"/>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Lila</label>
                                <input type="number" id="form6Example1" class="form-control" name="Lila"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Lingkar_Ukur</label>
                                <input type="number" id="form6Example1" class="form-control" name="Lingkar_Ukur"/>
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
