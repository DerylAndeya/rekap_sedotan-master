<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="pemesan";
    protected $guarded=[];
    protected static $searchableColumns = ['nama_pemesan'];
    public static function search($term)
    {
        $query = self::query();

        foreach (self::$searchableColumns as $column) {
            $query->orWhere($column, 'like', '%' . $term . '%');
        }

        return $query;
    }
}
