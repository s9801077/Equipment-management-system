<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public $timestamps = false;
    protected $table = 'equipments';
    protected $fillable = [
        'name', 'source', 'memo', 'amount', 'hasBarcode', 'prefix',
    ];

    public function barcode()
    {
        return $this->hasMany('App\EquipmentBarcode');
    }
}