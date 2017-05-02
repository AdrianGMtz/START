<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
	protected $fillable = ['description', 'price', 'type'];

	public function user() {
		return $this->belongsTo(User::Class);
	}

	public function images() {
		return $this->hasMany(Commission_Image::Class);
	}

	public function add(Commission_Image $image) {
		$this->images()->save($image);
	}
}
