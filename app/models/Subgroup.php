<?php 

class Subgroup extends Eloquent {

	protected $fillable = array('name');

	public function events() {
		return $this->belongsToMany('Myevent', 'event_subgroup')->withTimestamps();
	}

	public function groups() {
		return $this->belongsToMany('Group', 'group_subgroup')->withTimestamps();
	}

	public function users() {
		return $this->belongsToMany('User', 'subgroup_user')->withTimestamps();
	}
}