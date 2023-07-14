@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-6 col-sm-8 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-10">
                        <div class="numbers">
                           
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pasien Tertangani Hari Ini</p>
                            <h5 class="font-weight-bolder">
                                {{ $registrations }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-2 text-start" style="margin-left: -17px;">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-10">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Pasien Tertangani Minggu Ini</p>
                            <h5 class="font-weight-bolder">
                                {{ $mingguini }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-2 text-start" style="margin-left: -17px;">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-7 mb-lg-0 mb-4" style="
      height: 500px;
      width: 2000px;">
          <div class="card z-index-2 h-100">
              <div class="card-header pb-0 pt-3 bg-transparent">
                  <h6 class="text-capitalize">Pasien Tertangani PerBulan</h6>
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
  </div>  
</div>  

   
    
    <script src="{{ asset('/assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");
        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        var months = {!! json_encode($months) !!};
        var totals = {!! json_encode($totals) !!};
        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
          type: "line",
          data: {
            labels: months,
            datasets: [{
              label: "Jumlah Pendaftaran Pasien",
              data: totals, // Menggunakan data total sebagai data grafik
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#5e72e4",
              backgroundColor: gradientStroke1,
              borderWidth: 3,
              fill: true,
              maxBarThickness: 6
            }],
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              }
            },
            interaction: {
              intersect: false,
              mode: 'index',
            },
            scales: {
              y: {
                grid: {
                  drawBorder: false,
                  display: true,
                  drawOnChartArea: true,
                  drawTicks: false,
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  padding: 10,
                  color: '#fbfbfb',
                  font: {
                    size: 11,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false,
                  drawOnChartArea: false,
                  drawTicks: false,
                  borderDash: [5, 5]
                },
                ticks: {
                  display: true,
                  color: '#ccc',
                  padding: 20,
                  font: {
                    size: 11,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                  },
                }
              },
            },
          },
        });
      </script>
      <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
      </script>
    
@endsection