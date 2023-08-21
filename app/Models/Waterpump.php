<?php

namespace App\Models;

use App\Models\ServiceType;
use App\Models\SubServiceType;
use App\Models\VisitorHasService;
use App\Models\IndonesiaVillage;
use App\Models\IndonesiaDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Waterpump extends Model
{
	use HasFactory;

	public $table = 'waterpumps'; // dilakukan seperti ini agar tidak menjadi plural

	protected $guarded  = ['id']; //yang tidak  boleh di isi

}
