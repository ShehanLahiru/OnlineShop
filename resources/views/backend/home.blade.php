@extends('backend.layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'backend.home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
  {{-- <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div> --}}
  <div class="content" style = " background:linear-gradient(to right, #0c2646 0%, #204065 60%, #2a5788 100%);background-size: auto;">
    <canvas id="bigDashboardChart"  style="padding-top:110px"></canvas>
  </div>
  {{-- <div class="content"> --}}
    {{-- <div class="row">
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Global Sales</h5>
            <h4 class="card-title">Shipped Products</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="lineChartExample"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">2018 Sales</h5>
            <h4 class="card-title">All products</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Email Statistics</h5>
            <h4 class="card-title">24 Hours Performance</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="barChartSimpleGradientsNumbers"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card  card-tasks">
          <div class="card-header ">
            <h5 class="card-category">Backend development</h5>
            <h4 class="card-title">Tasks</h4>
          </div>
          <div class="card-body ">
            <div class="table-full-width table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked>
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="text-left">Sign contract for "What are conference organizers afraid of?"</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="text-left">Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked>
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
                    </td>
                    <td class="text-left">Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                    </td>
                    <td class="td-actions text-right">
                      <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </button>
                      <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category">All Persons List</h5>
            <h4 class="card-title"> Employees Stats</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    Name
                  </th>
                  <th>
                    Country
                  </th>
                  <th>
                    City
                  </th>
                  <th class="text-right">
                    Salary
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                    <td class="text-right">
                      $36,738
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Minerva Hooper
                    </td>
                    <td>
                      Curaçao
                    </td>
                    <td>
                      Sinaai-Waas
                    </td>
                    <td class="text-right">
                      $23,789
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Sage Rodriguez
                    </td>
                    <td>
                      Netherlands
                    </td>
                    <td>
                      Baileux
                    </td>
                    <td class="text-right">
                      $56,142
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Doris Greene
                    </td>
                    <td>
                      Malawi
                    </td>
                    <td>
                      Feldkirchen in Kärnten
                    </td>
                    <td class="text-right">
                      $63,542
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Mason Porter
                    </td>
                    <td>
                      Chile
                    </td>
                    <td>
                      Gloucester
                    </td>
                    <td class="text-right">
                      $78,615
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
@endsection

@push('js')
    <script>
        let date_array = @json($date_array);
        let count_array = @json($count_array);
        $(document).ready(function () {
            var ctx = document.getElementById('bigDashboardChart').getContext("2d");
            let chartColor = "#FFFFFF";
            var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, '#80b6f4');
            gradientStroke.addColorStop(1, chartColor);
            var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: date_array,
                    datasets: [{
                        label: "Data",
                        borderColor: chartColor,
                        pointBorderColor: chartColor,
                        pointBackgroundColor: "#1e3d60",
                        pointHoverBackgroundColor: "#1e3d60",
                        pointHoverBorderColor: chartColor,
                        pointBorderWidth: 1,
                        pointHoverRadius: 7,
                        pointHoverBorderWidth: 2,
                        pointRadius: 5,
                        fill: true,
                        backgroundColor: gradientFill,
                        borderWidth: 2,
                        data: count_array
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 0,
                            bottom: 0
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: '#fff',
                        titleFontColor: '#333',
                        bodyFontColor: '#666',
                        bodySpacing: 4,
                        xPadding: 12,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest"
                    },
                    legend: {
                        position: "bottom",
                        fillStyle: "#FFF",
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,0.4)",
                                fontStyle: "bold",
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                padding: 10
                            },
                            gridLines: {
                                drawTicks: true,
                                drawBorder: false,
                                display: true,
                                color: "rgba(255,255,255,0.1)",
                                zeroLineColor: "transparent"
                            }

                        }],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: "transparent",
                                display: false,

                            },
                            ticks: {
                                padding: 10,
                                fontColor: "rgba(255,255,255,0.4)",
                                fontStyle: "bold"
                            }
                        }]
                    }
                }
            });

        });

    </script>
@endpush
