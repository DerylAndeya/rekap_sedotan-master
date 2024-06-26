<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "invoice";
    protected $guarded = [];
    protected static $searchableColumns = ['nomor_invoice', 'tanggal', 'is_cash', 'FK_bank', 'FK_pegawai', 'FK_pemesan'];
    public static function search($term)
    {
        $query = self::query();

        foreach (self::$searchableColumns as $column) {
            $query->orWhere($column, 'like', '%' . $term . '%');
        }

        return $query;
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'FK_bank', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'FK_pegawai', 'id');
    }

    public function pemesan()
    {
        return $this->belongsTo(Pemesan::class, 'FK_pemesan', 'id');
    }
}
