<?php

namespace Atsargų_likučiai;

use Illuminate\Database\Eloquent\Model;

class Skyriai extends Model
{
    public $table = "Skyriai";
    protected $fillable = [
        'id',
        'NAME'

    ];
}
