<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model
{
    public $table = 'event';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'nama',
        'jenis_id',
        'tingkat_id',
        'lokasi',
        'tahun',
        'expired',
    ];

    public function dapil()
    {
        return $this->hasMany('App\Models\Dapil');
    }

    public function userEvent()
    {
        return $this->hasMany('App\Models\UserEvent');
    }

    public function tingkat()
    {
        return $this->belongsTo('App\Models\Tingkat');
    }

    public function jenis()
    {
        return $this->belongsTo('App\Models\Jenis');
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi', 'lokasi');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'lokasi', 'id');
    }

    //scope for query faster 
    public function scopeDropdown()
    {
      return Event::pluck('nama','id')->all();
    }

    public static function chart()
    {
        $dapil = new Dapil;
        $query = self::leftJoin("dapil", "dapil.event_id", "=", "event.id")
                 ->leftJoin("calon", "calon.dapil_id", "=", "dapil.id")
                 ->leftJoin("suara", "suara.calon_id", "=", "calon.id")
                 ->select("event.nama as event_nama",
                            "calon.nama as calon_nama",
                            "suara.jumlah as jumlah_suara"
                 );
                 // dd($query);
        return $query;
    }
}
