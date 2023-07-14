@extends('layouts.app')

@section('title', 'Edit Data Tindakan Medis Pasien')

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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h3>
                Edit Data Tindakan Medis Pasien
            </h3>
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>
        <form action="{{ route('tindakan_medis.update', $tindakan_medis->id_tindakan_medis) }}" method="POST">
            @csrf
            @method('PUT')
       
            <div class="card-body shadow-lg">
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Role Pasien</label>
                    <input type="text" id="form6Example3" class="form-control" name="role_id" />
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Vital sign</label>
                    <input type="text" id="form6Example1" value="{{ $tindakan_medis->id_vitalsign }}" class="form-control" name="id_vitalsign" readonly/>
                </div>
                {{-- <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Klinik</label>
                    <input type="text" id="form6Example3" class="form-control" value="kllinik cahaya abadi" readonly />
                            <input type="hidden" value="1" name="Klinik_id">
                </div> --}}
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nama Dokter</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $tindakan_medis->name }}"  readonly/>
                    <input type="hidden" value="{{ $tindakan_medis->id_dokter }}" name="id_dokter">
                </div>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Jenis Tindakan</label>
                            <input type="text" id="form6Example1" class="form-control"  value="{{ $tindakan_medis->jenis_tindakan }}" name="jenis_tindakan"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                            <label class="form-label" for="form6Example1">Hasil Tindakan</label>
                            <input type="text" id="form6Example1" class="form-control"  value="{{ $tindakan_medis->hasil_tindakan }}" name="hasil_tindakan"/>
                            </div>
                        </div>
                    </div>

                    <!-- Text input -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Tanggal Tindakan</label>
                                <input type="text" id="form6Example1" class="form-control" value="{{ $tindakan_medis->tanggal_tindakan }}" name="tanggal_tindakan"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">Obat</label>
                                {{-- <input type="text" id="form6Example1" class="form-control" name="id_obat"/> --}}
                                    <select class="form-control obat" name="id_obat[]" multiple="multiple">
                                            @foreach ($obat as $itemobat)
                                                <option value="{{ $itemobat->id_obat }}" selected>{{ $itemobat->nama_obat }}</option>
                                            @endforeach
                                            @foreach ($AllObat as $AllItem )
                                            <option value="{{ $AllItem->id_obat }}">{{ $AllItem->nama_obat }}</option>
                                            @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                    <!-- Text input -->
                <div class="card-footer">

                    <div class="d-grid gap-2">
                        
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <a href="{{ route('tindakan_medis.index') }}" class="btn btn-default" type="button">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.obat').select2();
        });
        $(document).ready(function() {
            $('.dokter').select2();
        });
    </script>
@endsection
