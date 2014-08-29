<?php 

class Subgroup extends Eloquent {

	protected $fillable = array('name');
	
	public function groups() {
		return $this->belongsToMany('Group', 'group_subgroup');
	}

	public function users() {
		return $this->belongsToMany('User', 'subgroup_user');
	}
}