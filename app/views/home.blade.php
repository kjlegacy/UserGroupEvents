@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-md-6 lgray">
		<form action="{{ URL::route('post-event') }}" method="post">
			<div class="col-md-10 col-xs-6">
				<input class="form-control" required="required" type="text" name="event" placeholder="Event">
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" class="btn btn-default">add event</button>
			</div>
		</form>

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Event</th>
				<th>Delete</th>
				<th>Toggel Groups <input  id="show-groups" type="checkbox" checked="1"> | Toggle subgroups <input  id="show-event-subgroups" type="checkbox" checked="1"></th>
			</tr>
			@foreach($events as $event)
			<tr>
				<td>{{ $event->id }}</td>
				<td><a href="{{ URL::action('event', $event->name) }}">{{ $event->name }}</a></td>
				<td>(<a href="{{ URL::action('delete-event', $event->id) }}">x</a>)</td>
				<td>
					<table class="table">
						<tr>
							<th>Groups</th>
							<th></th>
						</tr>
						@foreach($event->groups as $eventgroup)
						<tr class="group-toggle">
							<td>{{ $eventgroup->name }}</td>
							<td>
								<table class="table event-sub-toggle">
									<tr>
										<th>subgroups</th>
										<th>users</th>
									</tr>
								@foreach($eventgroup->subgroups as $event_group_subgroups)
									<tr>
										<td>{{ $event_group_subgroups->name }}</td>
										<td>
											<table>
											@foreach($event_group_subgroups->users as $e_g_s_user)
												<tr>
													<td>
														<!-- if user status yes -->
														<i class="glyphicon glyphicon-ok"></i> 
														<!-- if user status pending -->
														<!-- if user status no -->
														{{ $e_g_s_user->name }}
													</td>
												</tr>
											@endforeach
											</table>
										</td>
									</tr>
								@endforeach
								</table>
							</td>
						</tr>
						@endforeach
					</table>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	<div class="col-md-6 dgray">
		<form action="{{ URL::route('post-group') }}" method="post">
			<div class="col-md-10 col-xs-6">
				<input class="form-control" required="required" type="text" name="group" placeholder="Group">
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" class="btn btn-default">add group</button>
			</div>
		</form>

		<form action="{{ URL::route('post-group-to-event') }}" method="post">
			<table class="table">
				<tr>
					<th>ID</th>
					<th></th>
					<th>Group</th>
					<th>Subgroup(s) <input  id="show-subgroups" type="checkbox" checked="1"></th>
					<th>Delete</th>
					<th>{{ Form::select('event', Myevent::lists('name', 'id'), null, array('class' =>' form-control')) }}</th>
					<th><button class="btn btn-default">submit</button></th>
				</tr>
				@foreach($groups as $group)
				<tr>
					<td>{{ $group->id }}</td>
					<td><input type="checkbox" name="group[]" id="{{$group->id}}" value="{{$group->id}}"></td>
					<td><a href="{{ URL::action('group', $group->name) }}">{{ $group->name }}</a></td>
					<td>
						@foreach($group->subgroups as $group_subgroup)
							<table>
								<tr class="subgroup-toggle">
									<td>{{ $group_subgroup->name }}</td>
								</tr>
							</table>
						@endforeach
					</td>
					<td>(<a href="{{ URL::action('delete-group', $group->id) }}">x</a>)</td>
				</tr>
				@endforeach
			</table>
		</form>

		<div class="row">
		<div class="col-md-12">
			<form action="{{ URL::route('post-subgroup-to-event') }}" method="post">
			<table class="table">
				<tr>
					<th>Group</th>
					<th>Subgroup</th>
					<th>{{ Form::select('event', Myevent::lists('name', 'id'), null, array('class' =>' form-control')) }}</th>
					<th><button class="btn btn-default">submit</button></th>
				</tr>
				@foreach($groups as $group)
				<tr>
					<td>{{ $group->name }}</td>
					<td>
						@foreach($group->subgroups as $group_subgroup)
							<table>
								<tr class="subgroup-toggle">
									<td><input type="checkbox" name="subgroup[]" id="{{$group_subgroup->id}}" value="{{$group_subgroup->id}}"></td>
									<td>{{ $group_subgroup->name }}</td>
								</tr>
							</table>
						@endforeach
					</td>
				</tr>
				@endforeach
			</table>
			</form>
		</div>
		</div>
	</div>
	
</div> <!-- end first row -->
<hr>
<div class="row">
	<div class="col-md-6 dgray">
		<form action="{{ URL::route('post-subgroup') }}" method="post">
			<div class="col-md-10 col-xs-6">
				<input class="form-control" required="required" type="text" name="subgroup" placeholder="Subgroup">
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" class="btn btn-default">add subgroup</button>
			</div>
		</form>

		<form action="{{ URL::route('post-subgroup-to-group') }}" method="post">
			<table class="table">
				<tr>
					<th>ID</th>
					<th></th>
					<th>Subgroup</th>
					<th>Users <input id="show-users" type="checkbox" checked="1"></th>
					<th>Delete</th>
					<th>{{ Form::select('group', Group::lists('name', 'id'), null, array('class' =>' form-control')) }}</th>
					<th><button class="btn btn-default">submit</button></th>
				</tr>
			@foreach($subgroups as $subgroup)
				<tr>
					<td>{{ $subgroup->id }}</td>
					<td><input type="checkbox" name="subgroup[]" id="{{$subgroup->id}}" value="{{$subgroup->id}}"></td>
					<td>{{ $subgroup->name }}</td>
					<td>
						@foreach($subgroup->users as $subgroup_user)
						<table>
							<tr class="name-toggle">
								<td>{{ $subgroup_user->name }}</td>
							</tr>
						</table>
						@endforeach
					</td>
					<td>(<a href="{{ URL::action('delete-subgroup', $subgroup->id) }}">x</a>)</td>
				</tr>
			@endforeach
			</table>
		</form>
	</div>
	<div class="col-md-6 lgray">
		<form action="{{ URL::route('post-user') }}" method="post">
			<div class="col-md-10 col-xs-6">
				<input class="form-control" required="required" type="text" name="user" placeholder="User">
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" class="btn btn-default">add user</button>
			</div>
		</form>

		<form action="{{ URL::route('post-user-to-subgroup') }}" method="post">
			<table class="table">
				<tr>
					<th>ID</th>
					<th></th>
					<th>Users</th>
					<th>Delete</th>
					<th>Subgroup</th>
					<th>{{ Form::select('subgroup', Subgroup::lists('name', 'id'), null, array('class' =>' form-control')) }}</th>
					<th><button class="btn btn-default">submit</button></th>
				</tr>
				@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td><input type="checkbox" name="user[]" id="{{$user->id}}" value="{{$user->id}}"></td>
						<td><a href="{{ URL::action('user', $user->name) }}">{{ $user->name }}</a></td>
						<td>(<a href="{{ URL::action('delete-user', $user->id) }}">x</a>)</td>
						<td>
						<table class="table">
							@foreach($user->subgroups as $user_subgroup)
							<tr>
								<td>
									@if(isset($user->subgroups))
									<td>{{$user_subgroup->name}}</td>
								@else 
								@endif
								</td>
								<td>
									@if(!isset($user_subgroup->groups))
										<table>
										@foreach($user_subgroup->groups as $group)
											<tr>
											<td>{{$group->name}}</td>
											</tr>
										@endforeach
										</table>
									@else 
									@endif
								</td>
							</tr>
							@endforeach
						</table>
					</tr>
				@endforeach
			</table>
		</form>
	</div>
</div> <!-- end second row -->
<hr>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Users</th>
				<th>Events</th>
				<th>Attend</th>
				<th>Status</th>
			</tr>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>
					@foreach($user->events as $event)
						<ul>
							<li>{{$event->name}}</li>
						</ul>
					@endforeach
				</td>
				<td><button>yes</button><button>no</button></td>
				<td>status</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>


@foreach($events as $e)
@foreach($e->subgroups as $ad)

			<ul>
				<li>
					{{$ad->name}}
				</li>
			</ul>
@endforeach
@endforeach
@stop