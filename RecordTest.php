<?php

namespace Atsargų_likučiai;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordTest extends Model
{


    public $table = "recordstest";

    protected $fillable = [
        'id',
        'produkto_kodas',
        'produktas',
        'matas',
        'kiekis',
        'aprasymas',
        'tag'

    ];
}
