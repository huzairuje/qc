<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonPartai extends Model
{
    protected $table = 'calon_partai';

	protected $fillable = [
        'calon_id', 'partai_id'
    ];

    public function calon()
    {
        return $this->belongsTo('App\Models\Calon');
    }

    public function partai()
    {
        return $this->belongsTo('App\Models\Partai');
    }
}
