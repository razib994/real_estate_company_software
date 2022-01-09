<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visitor extends Model
{
   protected $fillable = ['name', 'email',  'phone', 'area',  'land',  'width', 'height',  'store', 'building',  'demand',  'designation', 'organization',  'date',  'remark',  'report',  'contact_id'];

    public static function getVisitor() {
        $records = DB::table('visitors')->select("id", 'name', 'email',  'phone', 'area',  'land',  'width', 'height',  'store', 'building',  'demand', 'organization',  'date',  'remark',  'report',  'contact_id')->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
