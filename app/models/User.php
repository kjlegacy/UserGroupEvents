<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('name');

	public function events() {
		return $this->belongsToMany('Myevent', 'event_user')->withPivot('subgroup_id','status')->withTimestamps();
	}

	public function subgroups() {
		return $this->belongsToMany('Subgroup', 'subgroup_user')->withTimestamps();
	}

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
