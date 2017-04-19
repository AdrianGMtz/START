<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
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
        $this->orders()->save($order);
    }

    public function publish(Commission $commission) {
        $this->commissions()->save($commission);
    }
}
