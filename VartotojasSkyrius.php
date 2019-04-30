<?php

namespace Atsargų_likučiai;

use Illuminate\Database\Eloquent\Model;

class VartotojasSkyrius extends Model
{
    public $table = "vartotojas_skyrius";
    protected $fillable = [
        'id',
        'VartotojoID',
        'SkyriausID'

    ];
}
