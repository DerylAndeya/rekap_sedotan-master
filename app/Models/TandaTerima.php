<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TandaTerima extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tanda_terima";
    protected $guarded=[];
    protected static $searchableColumns = ['FK_kode_invoice', 'tanggal', 'FK_jenis_kendaraan', 'plat', 'FK_pegawai', 'FK_pengirim' ,'FK_penerima'];
    public static function search($term)
    {
        $query = self::query();

        foreach (self::$searchableColumns as $column) {
            $query->orWhere($column, 'like', '%' . $term . '%');
        }

        return $query;
    }
}
