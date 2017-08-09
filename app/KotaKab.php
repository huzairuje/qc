<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KotaKab extends Model
{
	protected $table = 'kota_kabupaten';

    protected $fillable = [
        'nama'
    ];
}
