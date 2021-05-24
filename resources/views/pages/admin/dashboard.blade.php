@extends('layouts.dashboard')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Penghuni</h4>
              </div>
              <div class="card-body">
                  {{ $user }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
            <i class="fas fa-bed"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Kamar</h4>
              </div>
              <div class="card-body">
                {{ DB::table('rooms')->where('status','Tersedia')->count() }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-money-bill"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Transaksi</h4>
              </div>
              <div class="card-body">
                {{ $transactions }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-wallet"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Transaksi</h4>
              </div>
              <div class="card-body">
                Rp {{ number_format($total_price) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistik Jumlah Transaksi Setiap Bulan</h4>
              {{-- <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Week</a>
                  <a href="#" class="btn">Month</a>
                </div>
              </div> --}}
            </div>
            <div class="card-body">
              <canvas id="myChart" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('prepend-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($label); ?>,
            datasets: [{
                label: 'Jumlah transaksi',
                backgroundColor: [
                    'rgba(229, 229, 229,1)',
                ],
                borderColor: [
                    'rgba(229,229,229,1)',
                ],
                data: <?php echo json_encode($jumlah_transactions); ?>
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endpush
