<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Exports\LaporanSensorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDF; //library pdf
class DashboardLaporanController extends Controller
{

	public function __construct()
	{
		$this->middleware(function ($request, $next) {

			if (session('success')) {
				toast('Data Berhasil di Ubah!', 'success');
			}
			if (session('error')) {
				toast('Terjadi kesalahan', 'error');
			}

			return $next($request);
		});
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (auth()->guest()) {
			abort(403);
		}


		return view('dashboard.laporan.index', [

			'Device' => Device::orderBy('id','DESC')->get(),
		]);
	}
	public function export_excel(Request $request)
	{

		$start = $request->awal;
		$end = $request->akhir;

		return (new LaporanSensorExport)->forDate($start, $end)->download('Laporan Sensor Dari ' . $start . ' Sampai ' . $end . '.xlsx');
		// return Excel::download((new KunjunganExport)->forYear($start), 'kunjungan.xlsx');
	}

	public function export_pdf(Request $request){
		$start = $request->awal;
		$end = $request->akhir;
		$devices = Device::select('id', 'sensor_ph', 'sensor_moisture', 'sensor_flowrate', 'sensor_waterpressure', 'created_at', DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_created_at"))
    ->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN ? AND ?", [$start, $end])
    ->get();
		//mengambil data dan tampilan dari halaman laporan_pdf
		//data di bawah ini bisa kalian ganti nantinya dengan data dari database
		$data = PDF::loadview('dashboard.laporan.laporan_pdf',
		['Devices' => $devices]);
		//mendownload laporan.pdf
	return $data->download('laporan Data sensor'.$start.'-'.$end.'pdf');
}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function updateTamu(Request $request)
	{

		try {
			Visit::where('id', $request->visitor_id)
				->update([
					'status' => 1
				]);

			return  redirect('/dashboard/bukutamu')->with('success', 'Data Berhasil di Ubah!');
		} catch (\Throwable $th) {
			dd($th);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
