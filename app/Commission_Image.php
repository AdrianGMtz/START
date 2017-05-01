<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission_Image extends Model
{
    protected $fillable = ['commission_id', 'image'];

	public function commission() {
		return $this->belongsTo(commission::Class);
	}
}
