<?php

namespace App\Exports;

use App\Models\Device;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
class LaporanSensorExport implements FromView
{
	/**
	 * @return \Illuminate\Support\Collection
	 */

	use Exportable;


	public function forDate(string $start, string $end)
	{
		$this->start = $start;
		$this->end = $end;

		return $this;
	}

	public function view(): View
	{
		$devices = Device::select('id', 'sensor_ph', 'sensor_moisture', 'sensor_flowrate', 'sensor_waterpressure', 'created_at', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_created_at"))
    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN ? AND ?", [$this->start, $this->end])
    ->get();

		return view('dashboard.laporan.exports', [
			'start' => $this->start,
			'end' => $this->end,
			'Devices' => 	$devices
		]);
	}
}
