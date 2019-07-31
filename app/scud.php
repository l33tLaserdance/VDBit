<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scud extends Model
{
    protected $fillable = [
		'numBuild',
		'numLevel',
		'numDoor',
		'is_mag',
		'is_electrified',
		'is_worked',
		'email',
		'name',
		'info'
	];
}
