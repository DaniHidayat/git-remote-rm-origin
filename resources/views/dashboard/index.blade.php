@extends('dashboard.layouts.main')

@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> DASHBOARD</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DASHBOARD</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
               <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">PH Tanah</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
						  <!-- BAR CHART -->
							<div class="card card-success">
								<div class="card-header">
									<h3 class="card-title">Air(Liter) dan Tekanan Air</h3>

									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse">
											<i class="fas fa-minus"></i>
										</button>
										<button type="button" class="btn btn-tool" data-card-widget="remove">
											<i class="fas fa-times"></i>
										</button>
									</div>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
									</div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->



          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Kelembaban Tanah</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->




          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">


                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

            <section class="content">
                <div class="row">
                    <section class="col-lg-6 connectedSortable">

											<div class="card-body">

												PH
												<table id="example2" class="table table-bordered table-hover">
													<thead>
															<tr>
																	<th>#</th>
																	<th>Waktu-Tanggal</th>
																	<th>Nilai</th>
																	<th>Status</th>


															</tr>
													</thead>
													<tbody>
														@foreach ($Device as $device)
														<tr>
																<td>{{ $loop->iteration }}</td>
																<td>{{ $device->created_at }}</td>
																<td>{{ $device->sensor_ph}}</td>
																<td>
																	@if ($device->sensor_ph >= 0 && $device->sensor_ph <= 5.9)
																			<span class="badge badge-warning">Asam</span>
																	@elseif ($device->sensor_ph >= 6.5 && $device->sensor_ph <= 7.5)
																			<span class="badge badge-primary">Ideal</span>
																	@elseif ($device->sensor_ph >= 6 && $device->sensor_ph <= 8)
																			<span class="badge badge-success">Netral</span>

																	@elseif ($device->sensor_ph >= 8.1 || $device->sensor_ph > 14)
																			<span class="badge badge-danger">Basa</span>
																	@else
																			<span class="badge badge-secondary">Tidak Diketahui</span>
																	@endif
																	</td>



														</tr>
														@endforeach

													</tbody>

											</table>
												<div class="container mt-5">
													<div class="row">
															<div class="col-md-3">
																	<p><span class="badge badge-warning">0 - 5,9 = Asam</span></p>
															</div>
															<div class="col-md-3">
																	<p><span class="badge badge-success">6 - 8 = Netral</span></p>
															</div>
															<div class="col-md-3">
																	<p><span class="badge badge-danger">8,1 - 14 = Basa</span></p>
															</div>
															<div class="col-md-3">
																	<p><span class="badge badge-primary">6,5- 7,5 = Ideal</span></p>
															</div>
													</div>
												</div>
										</div>
										<!-- /.card-body -->

                    </section>
										<section class="col-lg-6 connectedSortable">
											<div class="card-body">
												Kelembaban
												<table id="example3" class="table table-bordered table-hover">
														<thead>
																<tr>
																		<th>#</th>
																		<th>Waktu-Tanggal</th>
																		<th>Nilai</th>
																		<th>Status</th>


																</tr>
														</thead>
														<tbody>
															@foreach ($Device as $device)
															<tr>
																	<td>{{ $loop->iteration }}</td>
																	<td>{{ $device->created_at }}</td>
																	<td>{{ $device->sensor_moisture }}</td>
																	<td>
																		@if ($device->sensor_moisture >= 0 && $device->sensor_moisture <= 300)
																				<span class="badge badge-danger">Kering</span>
																		@elseif ($device->sensor_moisture >= 301 && $device->sensor_moisture <= 600)
																				<span class="badge badge-success">Lembab</span>
																		@elseif ($device->sensor_moisture >= 601 && $device->sensor_moisture >= 900)
																				<span class="badge badge-primay">Basah</span>

																		@else
																				<span class="badge badge-secondary">Tidak Diketahui</span>
																		@endif
																		</td>


															</tr>
															@endforeach

														</tbody>

												</table>
												<div class="container mt-5">
													<div class="row">
															<div class="col-md-3">
																	<p><span class="badge badge-danger">0 - 300 Kering</span></p>
															</div>
															<div class="col-md-3">
																	<p><span class="badge badge-success">301 - 600 Lembab</span></p>
															</div>

															<div class="col-md-3">
																	<p><span class="badge badge-primary">601- 900 Basah</span></p>
															</div>
													</div>
												</div>
										</div>
										<!-- /.card-body -->

                    </section>
                </div>
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        @endsection
        @push('scripts')
				<script>
					$(function () {
						/* ChartJS
						 * -------
						 * Here we will create a few charts using ChartJS
						 */

						//--------------
						//- AREA CHART -
						//--------------

						// Get context with jQuery - using jQuery's .get() method.


						var areaChartData = {
							labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
							datasets: [
								{
									label               : 'Digital Goods',
									backgroundColor     : 'rgba(60,141,188,0.9)',
									borderColor         : 'rgba(60,141,188,0.8)',
									pointRadius          : false,
									pointColor          : '#3b8bba',
									pointStrokeColor    : 'rgba(60,141,188,1)',
									pointHighlightFill  : '#fff',
									pointHighlightStroke: 'rgba(60,141,188,1)',
									data                : [28, 48, 40, 19, 86, 27, 90]
								},
								{
									label               : 'Electronics',
									backgroundColor     : 'rgba(210, 214, 222, 1)',
									borderColor         : 'rgba(210, 214, 222, 1)',
									pointRadius         : false,
									pointColor          : 'rgba(210, 214, 222, 1)',
									pointStrokeColor    : '#c1c7d1',
									pointHighlightFill  : '#fff',
									pointHighlightStroke: 'rgba(220,220,220,1)',
									data                : [65, 59, 80, 81, 56, 55, 40]
								},
							]
						}

						var areaChartOptions = {
							maintainAspectRatio : false,
							responsive : true,
							legend: {
								display: false
							},
							scales: {
								xAxes: [{
									gridLines : {
										display : false,
									}
								}],
								yAxes: [{
									gridLines : {
										display : false,
									}
								}]
							}
						}

						// This will get the first returned node in the jQuery collection.
						// var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
						// new Chart(areaChartCanvas, {
						// 	type: 'line',
						// 	data: areaChartData,
						// 	options: areaChartOptions
						// })

						var ctx = document.getElementById('areaChart').getContext('2d');
            var areaChart = new Chart(ctx, {
                type: 'line',
                data: {
									labels: {!! json_encode($labels) !!},
                    datasets: [
											{
                        label: 'Minggu ini ',
												data: {!! json_encode($data) !!},
                        fill: true,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(60,141,188,0.8)',
                        pointBorderColor: 'rgba(60,141,188,0.8)',
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: 'rgba(60,141,188,0.8)',
                        pointHoverBorderColor: 'rgba(60,141,188,0.8)',
                        tension: 0.3
                    },
										{
									label               : 'Minggu Kemarin',
									backgroundColor     : 'rgba(210, 214, 222, 1)',
									borderColor         : 'rgba(210, 214, 222, 1)',
									pointRadius         : false,
									pointColor          : 'rgba(210, 214, 222, 1)',
									pointStrokeColor    : '#c1c7d1',
									pointHighlightFill  : '#fff',
									pointHighlightStroke: 'rgba(220,220,220,1)',
									data								: {!! json_encode($dataKemarin) !!},
								},]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                },
            });

										//-------------
						//- BAR CHART -
						//-------------
						// Data for the bar chart
						var data = {
							labels: {!! json_encode($labelsB) !!}, // Menggunakan labels minggu ini
							datasets: [
								{
									label               : 'Debit Air',
									backgroundColor     : 'rgba(60,141,188,0.9)',
									borderColor         : 'rgba(60,141,188,0.8)',
									pointRadius          : false,
									pointColor          : '#3b8bba',
									pointStrokeColor    : 'rgba(60,141,188,1)',
									pointHighlightFill  : '#fff',
									pointHighlightStroke: 'rgba(60,141,188,1)',
									data								: {!! json_encode($dataB) !!},
								},
								{
									label               : 'Tekanan Air',
									backgroundColor     : 'rgba(210, 214, 222, 1)',
									borderColor         : 'rgba(210, 214, 222, 1)',
									pointRadius         : false,
									pointColor          : 'rgba(210, 214, 222, 1)',
									pointStrokeColor    : '#c1c7d1',
									pointHighlightFill  : '#fff',
									pointHighlightStroke: 'rgba(220,220,220,1)',
									data								: {!! json_encode($dataKemarinB) !!},
								},
							]
        };

        // Options for the bar chart
        var options = {
            scales: {
                y: {
                    beginAtZero: true // Start the y-axis from zero
                }
            }
        };

        // Create the bar chart
        var ctx = document.getElementById('barChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

					//-------------
					//- LINE CHART -
					//--------------
					var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
					var lineChartOptions = $.extend(true, {}, areaChartOptions);

					// Data untuk minggu ini
					var lineChartData = {
						labels: {!! json_encode($labelsM) !!}, // Menggunakan labels minggu ini
						datasets: [
							{
								label: 'Garis Pertama', // Menambahkan label untuk garis pertama
								data: {!! json_encode($dataM) !!}, // Menggunakan data minggu ini
								fill: false,
								backgroundColor: 'rgba(60,141,188,0.9)',
								borderColor: 'rgba(60,141,188,0.8)',
								pointRadius: 5,
								pointBackgroundColor: 'rgba(60,141,188,0.8)',
								pointBorderColor: 'rgba(60,141,188,0.8)',
								pointHoverRadius: 5,
								pointHoverBackgroundColor: 'rgba(60,141,188,0.8)',
								pointHoverBorderColor: 'rgba(60,141,188,0.8)',
								tension: 0.3
							},
						]
					};

					// Data untuk minggu kemarin
					var lineChartDataKemarin = {
						labels: {!! json_encode($labelsKemarinM) !!}, // Menggunakan labels minggu kemarin
						datasets: [
							{
								label: 'Garis Kedua', // Menambahkan label untuk garis kedua
								data: {!! json_encode($dataKemarinM) !!}, // Menggunakan data minggu kemarin
								fill: false,
								backgroundColor: 'rgba(210, 214, 222, 1)',
								borderColor: 'rgba(210, 214, 222, 1)',
								pointRadius: false,
								pointColor: 'rgba(210, 214, 222, 1)',
								pointStrokeColor: '#c1c7d1',
								pointHighlightFill: '#fff',
								pointHighlightStroke: 'rgba(220,220,220,1)',
							},
						]
					};

					lineChartOptions.datasetFill = false;
					// Gabungkan data dari minggu ini dan minggu kemarin ke dalam satu array datasets
					lineChartData.datasets = lineChartData.datasets.concat(lineChartDataKemarin.datasets);

					var lineChart = new Chart(lineChartCanvas, {
						type: 'line',
						data: lineChartData,
						options: lineChartOptions
					});
					})
				</script>

        @endpush
