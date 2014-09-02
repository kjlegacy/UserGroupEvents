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

	public function getUser($user) {
		$user_data = User::where('name', $user)->get();
		return View::make('user')
				->with('user_data', $user_data);
	}

	public function getGroup($group) {
		$group_data = Group::where('name', $group)->get();
		return View::make('group')
				->with('group_data', $group_data);
	}

	public function getEvent($event) {
		$event_data = Myevent::where('name', $event)->get();
		return View::make('event')
				->with('event_data', $event_data);
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

	public function deleteEvent($id) {
		$event = Myevent::find($id);
		$event->groups()->detach();
		$event->users()->detach();
		$event->delete();

		return Redirect::to('/');
	}

	public function postGroup() {
		$group_name = Input::get('group');
		$new_group 	= Group::create(array(
			'name' 	=> $group_name
		));

		return Redirect::to('/');
	}

	public function detachGroup() {
		$event_id = Input::get('event_id');
		$group_id = Input::get('group');
		$event 	  = Myevent::find($event_id);
		$group 	  = Group::find($group_id);

		dd($group);

		$group->subgroups()->detach($subgroup_id);
		return Redirect::to('/');
	}

	public function deleteGroup($id) {
		$group = Group::find($id);
		$group->subgroups()->detach();
		$group->delete();

		return Redirect::to('/');
	}

	public function postSubgroup() {
		$subgroup_name 	= Input::get('subgroup');
		$new_subgroup 	= Subgroup::create(array(
			'name' 		=> $subgroup_name
		));

		return Redirect::to('/');
	}

	public function detachSubgroup() {
		$group_id 	 = Input::get('group_id');
		$subgroup_id = Input::get('subgroup');
		$group 		 = Group::find($group_id);
		$subgroup 	 = Subgroup::find($subgroup_id);

		$group->subgroups()->detach($subgroup_id);
		return Redirect::to('/');
	}

	public function deleteSubgroup($id) {
		$subgroup = Subgroup::find($id);
		$subgroup->users()->detach();
		$subgroup->groups()->detach();
		$subgroup->delete();

		return Redirect::to('/');
	}

	public function postUser() {
		$user_name 	= Input::get('user');
		$existing_user = User::where('name', $user_name)->first();

		if($existing_user) {
			return Redirect::to('/')
					->with('error', $user_name.' already exists, please pick another one.');
		} else {
			$new_user 	= User::create(array(
			'name' 	=> $user_name
			));
			return Redirect::to('/');
		}
	}

	public function detachUser() {
		$user_id 	 = Input::get('user_id');
		$subgroup_id = Input::get('subgroup');
		$user 		 = User::find($user_id);
		$subgroup 	 = Subgroup::find($subgroup_id);

		$user->subgroups()->detach($subgroup_id);
		return Redirect::to('/');
	}

	public function deleteUser($id) {
		$user = User::find($id);
		$user->subgroups()->detach();
		$user->delete();
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

	public function postSubgroupToEvent() {
		$selected_subgroups = Input::get('subgroup');
		$selected_event  	= Input::get('event');
		$event 			 	= Myevent::find($selected_event);


		if(isset($selected_subgroups)) {
			foreach($selected_subgroups as $subgroup_id) {
				$subgroup = Subgroup::find($subgroup_id);

				// tean mis GRUPIS see subgroup on milles ta läheb eventile
				foreach($subgroup->groups as $group) {
					$group = Group::find($group->id);
				}
				
				foreach($subgroup->users as $user) {
					$user = User::find($user->id);
				}

				$subgroup->events()->attach($event->id);
				$group->events()->attach($event->id);
				$user->events()->attach($event->id);
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
