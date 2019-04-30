<?php

namespace Atsargų_likučiai;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public $table = "records";

    protected $fillable = [
        'id',
        'produkto_kodas',
        'produktas',
        'matas',
        'kiekis',
        'tag'

    ];
}
