<?php 

class Group extends Eloquent {

	protected $fillable = array('name');

	public function events() {
		return $this->belongsToMany('Myevent', 'event_group')->withTimestamps();
	}

	public function subgroups() {
		return $this->belongsToMany('Subgroup', 'group_subgroup')->withTimestamps();
	}
}