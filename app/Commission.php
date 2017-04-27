<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
	protected $fillable = ['description', 'price', 'type'];

	public function user() {
		return $this->belongsTo(User::Class);
	}
}
