<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="invoice";
    protected $guarded=[];

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'FK_metode_pembayaran', 'id');
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
