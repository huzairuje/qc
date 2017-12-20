<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datasaksi_monitoring extends Model
{
    protected $table = 'data_saksi';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
    protected $fillable = [
        'nama',
        'alamat',
        'no_telpon',
        'email',
        'password',
        'id_tps',
        'foto',
    ];
}
