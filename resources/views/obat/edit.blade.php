@extends('layouts.app')

@section('title', 'Edit Obat')

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
                Edit Data Obat
            </h3>
            <a href="{{ URL::previous() }}" class="btn btn-primary ml-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>

        {!! Form::model($obat, ['method' => 'PATCH','route' => ['obat.update', $obat->id_obat]]) !!}
            <div class="card-body shadow-lg">
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Nama Obat</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $obat->nama_obat }}" name="nama_obat"/>
                            <input type="hidden" value="1" >
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example3">Harag Obat</label>
                    <input type="text" id="form6Example3" class="form-control" value="{{ $obat->harga_obat }}" name="harga_obat"/>
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
                        <a href="{{ route('pendaftaran_pasien.index') }}" class="btn btn-default" type="button">Batal</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
@endsection
