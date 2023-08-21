<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Device;
use App\Models\Waterpump;
use Illuminate\Http\Request;
use App\Exports\KunjunganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DashboardPompaAirController extends Controller
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


		return view('dashboard.pompaAir.index', [

			'Device' => Device::orderBy('id','DESC')->get(),
		]);
	}
	public function updateStatus(Request $request)
    {
        // Retrieve the data sent via AJAX
        $isChecked = $request->input('isChecked');
				$item = Waterpump::find(1);

        // Perform any necessary actions with the data here (e.g., update database)
				$item->status = $isChecked;
					// Save the changes to the database
				$item->save();


        // Return a response (if needed)
        return response()->json([
					'message' => 'Status updated successfully',
					'data' =>  $isChecked
			]);
    }
		public function checkStatus(Request $request)
    {

				$item = Waterpump::find(1);

        // Perform any necessary actions with the data here (e.g., update database)



        // Return a response (if needed)
        return response()->json([

					'data' =>  $item->status
			]);
    }
	public function export_excel(Request $request)
	{

		$start = $request->awal;
		$end = $request->akhir;

		return (new KunjunganExport)->forDate($start, $end)->download('Laporan Kunjungan Dari ' . $start . ' Sampai ' . $end . '.xlsx');
		// return Excel::download((new KunjunganExport)->forYear($start), 'kunjungan.xlsx');
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
