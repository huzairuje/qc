<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPJTPSMonitoring extends Model
{
    protected $table = 'data_korsak';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
    protected $fillable = [
        'nama',
        'alamat',
        'no_telpon',
        'email',
        'password',
        'list_id_tps',
        'foto',
    ];
}
