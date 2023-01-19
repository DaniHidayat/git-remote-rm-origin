<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpsiJawaban extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'opsi_jawaban'; // dilakukan seperti ini agar tidak menjadi plural

    protected $fillable = [
        'answer_value',
        'answer_description',
        'answer_icon',
    ];
}
