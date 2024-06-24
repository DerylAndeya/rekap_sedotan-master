<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="transaksi";
    protected $guarded=[];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'FK_kode_invoice', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'FK_kode_barang', 'id');
    }
}
