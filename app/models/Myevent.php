<?php 

class Myevent extends Eloquent {

	protected $fillable = array('name');

	public function groups() {
		return $this->belongsToMany('Group', 'event_group');
	}

	public function users() {
		return $this->belongsToMany('User', 'event_user');
	}
}