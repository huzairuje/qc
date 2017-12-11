<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
	protected $table = 'tps';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'nama_tps',
        'no_tps',
        'calon_id',
        'kelurahan_id'
    ];

    public function kelurahan()
    {
        return $this->belongsTo('App\Kelurahan');
    }
}
