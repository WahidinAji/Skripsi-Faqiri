@extends('layouts.main')
@section('title','Transactions')
@section('main-content')
{{-- <div class="card">
    <div class="card-header py-2">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Items</h6>
    </div>
    <div class="card-body">
        <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-dark">
                    <th class="align-middle" scope="col">#</th>
                    <th class="align-middle" scope="col">Kode Transaksi</th>
                    <th class="align-middl" scope="col">Harga <small><strong>Rp.</strong></small></th>
                    <th class="align-middle text-center" scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($days as $day)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $day->code }}</td>
                    <td>{{ number_format($day->price_total,2,".",",") }}</td>
                    <td>{{ $day->date }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Data kosong!!!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div> --}}
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Items</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-dark">
                            <th class="align-middle" scope="col">#</th>
                            <th class="align-middle" scope="col">Kode Transaksi</th>
                            <th class="align-middl" scope="col">Harga <small><strong>Rp.</strong></small></th>
                            <th class="align-middle text-center" scope="col">Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($days as $day)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $day->code }}</td>
                            <td>{{ number_format($day->price_total,2,".",",") }}</td>
                            <td>{{ $day->date }}</td>
                            <td>
                                <a href="{{ route('transactions.show',$day->id) }}" class="btn btn-outline-info btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Data kosong!!!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Donut Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-2">
                <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                </div>
                <hr>
                Styling for the donut chart can be found in the
                <code>/js/demo/chart-pie-demo.js</code> file.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col col-sm-8 mt-2">
                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                    </div>
                    <div class="col col-sm-4 text-right">
                        <form action="{{ url()->current() }}">
                            <div class="form-row">
                                <div class="col col-md-7 text-right">
                                    <select name="years" id="years" class="form-control form-control-sm">
                                        <option value="">Pilih tahun</option>
                                        @foreach ($years as $y)
                                        <option value="{{ $y->year_ }}" {{ $y->year_ == request('years') ? "selected" : null }}>{{ $y->year_ }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-md-5 text-right">
                                    <button type="submit" class="btn btn-sm btn-info">urutkan</button>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary">clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
                <hr>
                Total transaksi setiap bulannya tahun
                <code>{{ request('years') ?? '2021' }}</code>.
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>
    <!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <!-- Page level Chart -->
    <!-- Bar Chart Example -->
<script>
    const json_bar = {!! $transactions !!};
    const map_price = json_bar.map(element => element.price);
    const map_month = json_bar.map(element => element.month_);
    console.log(map_price);
    const months_convert = Array.from(map_month, (e, i) => {
            // console.log(e);
            switch (e) {
                case 1:
                    i = e
                    break;
                case 2:
                    i = e
                    break;
                case 3:
                    i = e
                    break;
                case 4:
                    i = e
                    break;
                case 5:
                    i = e
                    break;
                case 6:
                    i = e
                    break;
                case 7:
                    i = e
                    break;
                case 8:
                    i = e
                    break;
                case 9:
                    i = e
                    break;
                case 10:
                    i = e
                    break;
                case 11:
                    i = e
                    break;
                case 12:
                    i = e
                    break;
            }
            return new Date(null, i, null).toLocaleDateString("en", {
                month: "long"
            });
        });
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months_convert,
            datasets: [{
                label: "Revenue",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: map_price,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                    unit: 'month'
                    },
                    gridLines: {
                    display: false,
                    drawBorder: false
                    },
                    ticks: {
                    maxTicksLimit: 12
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: Math.max(...map_price),
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return 'Rp. ' + number_format(value);
                    }
                    },
                    gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });
</script>
    <!-- Pie Chart Example -->
<script>
    const map_ = json_bar.map(element => element.total);
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: months_convert,
            datasets: [{
            data: map_,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc','#a83232','#a85b32','#ffff57','#aeff57','#57ffa5','#57fff9','#57a0ff','#57a0ff','#e957ff'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf','#a83232','#a85b32','#ffff57','#aeff57','#57ffa5','#57fff9','#57a0ff','#57a0ff','#e957ff'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: true,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>
@endpush
