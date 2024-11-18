@extends('layouts.admin')

@section('title', __('Home'))

@section('content')
<h2 class="mb-4"> Xin chào {{ request()->user()->name }}</h2>

<div class="row">
    {{-- <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lượt xem 24h qua</h3>
            </div>
          
            <div class="card-body">

            </div>
            <div class="card-footer">
            </div>

        </div>

    </div> --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Lượt xem 30p qua</h3>
                    <p class="card-subtitle">
                      Total views: {{ $chartData->sum('total_views') }}
                    </p>
                  </div>
              </div>
            <div class="card-body">

                <div id="chart_real_time_30m" class="chart-lg" style="min-height: 240px;"></div>

            </div>


        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
      document.addEventListener("DOMContentLoaded", function () {
    // Dữ liệu từ PHP controller
    var chartData = @json($chartData);

    var options = {
        series: [{
            name: 'Views',
            data: chartData.map(item => item.total_views)
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: chartData.map(item => {
                let date = new Date(item.minute_time);
                return date.getHours().toString().padStart(2, '0') + ':' + 
                    date.getMinutes().toString().padStart(2, '0');
            })
        },
        fill: {
            opacity: 1
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart_real_time_30m"), options);
    chart.render();
    });
</script>
@endpush