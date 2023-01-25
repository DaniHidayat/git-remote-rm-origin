<?php

namespace App\Http\Controllers;

use Laravolt\Indonesia\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ServiceType;
use App\Models\Visit;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Session;
use App\Models\SubServiceType;
use App\Models\VisitorHasService;
use Illuminate\Support\Facades\DB;

class BukuTamuController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			if (session('QuestionAlert')) {
				// Alert::success(session('success'));
				Alert::question('Terimakasih', 'Apakah Ingin Mengisi Survey?');
				// Alert::info('Terimakasih', 'Data anda berhasil disimpan!');
			}

			if (session('success')) {
				toast('Terimakasih Telah Mengisi Survey', 'success');
			}

			if (session('SurveyAlert')) {
				// Alert::success(session('success'));
				Alert::info('Terimakasih', 'Data survey anda berhasil disimpan!');
			}


			if (session('error')) {
				toast('Terjadi kesalahan', 'error');
			}

			return $next($request);
		});
	}

	public function index()
	{
		$kecamatan = \Indonesia::findCity(167, ['districts'])->districts->pluck('name', 'id');

		return view('bukuTamu.index', [
			"title" => "Buku Tamu",
			"active" => "Buku Tamu",
			'serviceType' => ServiceType::all(),
			'kecamatan' => $kecamatan
		]);
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

		try {
			$validateData = $request->validate([
				'id_service_type' => 'required',
				'visitor_name' => 'required',
				'visitor_education' => 'required',
				'visit_time' => 'required',
				'visitor_village' => '',
				'visitor_disctrict'  =>   '',
				'visitor_address' => '',
				'visitor_neighborhood_association' => '',
				'visitor_citizen_association' =>   '',
				'visitor_age' => 'required',
				'visitor_gender' => 'required',
				'visit_purpose' => 'required',
				'visitor_description' => '',
			]);

			if ($request->visitor_address === null) {
				$validateData['visitor_address'] = $request->visitor_address_detail;
			}



			try {
				$last = Visit::create($validateData);
				$arr = [];
				foreach ($request->id_sub_service_type as $value) {
					$temp = explode('|', $value);

					$arr[] =  [
						'visitor_id' => $last->id,
						'service_id' => 	$temp[0],
						'sub_service_id' => 	$temp[1]
					];
				}




				DB::table('visitor_has_services')->insert($arr);
				session($validateData);
				return redirect('/')->with('QuestionAlert', 'Created successfully!');
			} catch (\Throwable $th) {
				dd($th);
				return redirect('/')->with('error', 'Error during the creation!');
			}
			//code...
		} catch (\Throwable $th) {
			//throw $th;
			return redirect('/')->with('error', 'Error during the creation!');
		}
	}

	public function remove()
	{

		session()->invalidate();
		session()->regenerateToken();
		return redirect('/');
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
	public function update(Request $request, $id)
	{
		//
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
	public function subJenisLayanan(Request $request)
	{

		$input = $request->all();


		$data =  ServiceType::with('subServices')->whereIn('id_service_type', $input['id'])->get();


		return response()->json([
			"data" => $data
		]);
	}
}
