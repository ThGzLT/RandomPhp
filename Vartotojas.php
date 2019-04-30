<?php

namespace Atsargų_likučiai;

use Illuminate\Database\Eloquent\Model;

class Vartotojas extends Model
{
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'password'
    ];
}
