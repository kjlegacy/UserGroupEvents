<?php 

class Myevent extends Eloquent {

	protected $fillable = array('name');

	public function groups() {
		return $this->belongsToMany('Group', 'event_group')->withTimestamps();
	}

	public function subgroups() {
		return $this->belongsToMany('Subgroup', 'event_subgroup')->withTimestamps();
	}

	public function users() {
		return $this->belongsToMany('User', 'event_user')->withPivot('subgroup_id','status')->withTimestamps();
	}
}