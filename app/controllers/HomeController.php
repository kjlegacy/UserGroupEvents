<?php

class HomeController extends BaseController {

	public function getHome() {

		$events 	= Myevent::all();
		$groups 	= Group::all();
		$subgroups 	= Subgroup::all();
		$users 		= User::all();
		return View::make('home')
				->with('events', $events)
				->with('groups', $groups)
				->with('subgroups', $subgroups)
				->with('users', $users);
	}

// ----------------------------------- //
// --------------Adding--------------- //
// ----------------------------------- //

	public function postEvent() {
		$event_name = Input::get('event');
		$new_event = Myevent::create(array(
			'name' => $event_name
		));

		return Redirect::to('/');
	}

	public function postGroup() {
		$group_name = Input::get('group');
		$new_group 	= Group::create(array(
			'name' 	=> $group_name
		));

		return Redirect::to('/');
	}

	public function postSubgroup() {
		$subgroup_name 	= Input::get('subgroup');
		$new_subgroup 	= Subgroup::create(array(
			'name' 		=> $subgroup_name
		));

		return Redirect::to('/');
	}

	public function postUser() {
		$user_name 	= Input::get('user');
		$new_user 	= User::create(array(
			'name' 	=> $user_name
		));

		return Redirect::to('/');
	}

// ----------------------------------- //
// ------------Connecting------------- //
// ----------------------------------- //

	public function postGroupToEvent() {
		$selected_groups = Input::get('group');
		$selected_event  = Input::get('event');
		$event 			 = Myevent::find($selected_event);

		if(isset($selected_groups)) {
			foreach($selected_groups as $group_id) {
				$group = Group::find($group_id);

				foreach($event->groups as $node) {
					if($node->id == $group->id) {
						return Redirect::to('/')
								->with('error', $node->name .' is already in '. $event->name . ' event!');
					} 
				}

				$group->events()->attach($event->id);
			}
		} else {
			return Redirect::to('/')
					->with('error', 'No groups were checked!');
		}

		return Redirect::to('/');
	}

	public function postSubgroupToGroup() {
		$selected_subgroups = Input::get('subgroup');
		$selected_group 	= Input::get('group');
		$group 				= Group::find($selected_group);

		if(isset($selected_subgroups)) {
			foreach($selected_subgroups as $subgroup_id) {
				$subgroup = Subgroup::find($subgroup_id);

				foreach($group->subgroups as $node) {
					if($node->id == $subgroup->id) {
						return Redirect::to('/')
								->with('error', $node->name .' is already in '. $group->name);
					} 
				}

				$subgroup->groups()->attach($group->id);
			}
		} else {
			return Redirect::to('/')
					->with('error', 'No subgroups were checked!');
		}

		return Redirect::to('/');
	}

	public function postUserToSubgroup() {
		$selected_users 	= Input::get('user');
		$selected_subgroup 	= Input::get('subgroup');
		$subgroup 			= Subgroup::find($selected_subgroup);

		// giving the User a subgroup
		if(isset($selected_users)) {
			foreach($selected_users as $user_id) {
				$user = User::find($user_id);

				foreach($subgroup->users as $member) {
					if($member->id == $user->id) {
						return Redirect::to('/')
								->with('error', $member->name .' is already in '. $subgroup->name);
					} 
				}

				$user->subgroups()->attach($subgroup->id);
			}
		} else {
			return Redirect::to('/')
					->with('error', 'No users were checked!');
		}
		
		return Redirect::to('/');
	}
}
