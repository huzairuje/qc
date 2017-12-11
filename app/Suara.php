<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suara extends Model
{
	protected $table = 'suara';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'tps_id',
        'calon_id',
        'jumlah'
    ];

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}
