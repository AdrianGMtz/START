<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'username', 'password', 'email_token', 'verified'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function commissions() {
		return $this->hasMany(Commission::Class);
	}

	public function orders() {
		return $this->hasMany(Order::Class);
	}

	public function order(Order $order) {
		$order = $this->orders()->save($order);
		return $order->id;
	}

	public function publish(Commission $commission) {
		$this->commissions()->save($commission);
	}

	public function verified()
	{
		$this->verified = 1;
		$this->email_token = null;
		$this->save();
	}
}
