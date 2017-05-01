<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['client_id', 'commission_id', 'order_comments', 'paid', 'file'];

	public function user() {
		return $this->belongsTo(User::Class);
	}
}
