@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- @if ($perawat->name == 'klinik') --}}
    {{-- <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4" style="
        height: 500px;
        width: 2000px;">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Jumlah Obat PerBulan</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2021
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>                       --}}
    {{-- @else --}}
    <div class="row">
        <div class="col-xl-6 col-sm-8 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                            
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun User Dokter</p>
                                <h5 class="font-weight-bolder">
                                    {{ $perawat }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-2 text-start" style="margin-left: -17px;">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 ">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun User Pasien</p>
                                <h5 class="font-weight-bolder">
                                    {{ $Dokter }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-2 text-start" style="margin-left: -17px;">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun User Klinik</p>
                                <h5 class="font-weight-bolder">
                                    {{ $klinik }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-2 text-start" style="margin-left: -17px;">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun User Kasir</p>
                                <h5 class="font-weight-bolder">
                                    {{ $kasir }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-2 text-start" style="margin-left: -17px;">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4 mr-3 mt-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Akun User perawat</p>
                                <h5 class="font-weight-bolder">
                                    {{ $perawat }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-2 text-start" style="margin-left: -17px;">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>  
    {{-- @endif --}}
@endsection