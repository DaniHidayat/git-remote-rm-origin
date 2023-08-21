<table>
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
