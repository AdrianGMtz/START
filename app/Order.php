<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'commission_id', 'paid'];

    public function user() {
    	return $this->belongsTo(User::Class);
    }
}
