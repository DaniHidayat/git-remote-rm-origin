
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>


		  <table class="table table-bordered">
				<thead>
						<tr>
								<th>#</th>
								<th>Waktu-Tanggal</th>
								<th>Nilai ph</th>
								<th>Nilai kelembaban</th>
								<th>Nilai Debit Air</th>
								<th>Nilai Tekanan Air</th>


						</tr>
				</thead>
				<tbody>
						@foreach ($Devices as $device)
						<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $device->created_at }}</td>
								<td>{{ $device->sensor_ph }}</td>
								<td>{{ $device->sensor_moisture }}</td>
								<td>{{ $device->sensor_flowrate }}</td>
								<td>{{ $device->sensor_waterpressure }}</td>


						</tr>
						@endforeach
				</tbody>

			</table>

</body>

</html>
