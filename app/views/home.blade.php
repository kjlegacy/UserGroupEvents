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
		<th>Subgroups</th>
	</tr>
@foreach($events as $event)
				<?php $event_id = $event->id; ?>
	<tr>
		<td>{{$event->id}}</td>
		<td><a href="{{ URL::action('event', $event->name) }}">{{$event->name}}</a></td>
		<td>(<a href="{{ URL::action('delete-event', $event->id) }}">x</a>)</td>
		<td>
			<table class="table table-bordered">
			@if($event->subgroups)
			@foreach($event->subgroups as $event_subgroup)
				<?php $subgroup_id = $event_subgroup->id; ?>
			@foreach($event_subgroup->groups as $subgroup_group)
				<?php $group_id = $subgroup_group->id; ?>
				<tr>
					<td>
						<table class="table table-bordered">
							<tr>
								<td>{{$subgroup_group->name}}</td>
							</tr>
							<tr>
								<th>{{$event_subgroup->name}}</th>
							</tr>
						</table>
					</td>
			@endforeach
					<td>
					
						<table class="table table-bordered">
						@foreach($event_subgroup->users as $subgroup_user)
							<tr>
								<td>{{$subgroup_user->name}}</td>			
								@foreach($subgroup_user->events as $status)
								 @if($status->pivot->myevent_id == $event_id && $status->pivot->subgroup_id == $subgroup_id)
                                            @if($status->pivot->status == 2)
                                                <td style="width:30px"><div class="btn btn-warning"><i class="glyphicon glyphicon-question-sign"></i></div></td>
                                            @elseif($status->pivot->status == 1)
                                                <td style="width:30px"><div class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i></div></td>
                                            @elseif($status->pivot->status == 0)
                                                <td style="width:30px"><a href="#"><div class="btn btn-danger"><i class="glyphicon glyphicon-remove-circle"></i></div></a></td>
                                            @endif
                                        @endif						
                                @endforeach
							</tr>
						@endforeach
						</table>
					</td>
				</tr>
			@endforeach
			@else 
			@endif
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
				<th>Event</th>
			</tr>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->name }}</td>
				<td>
					<table class="table table-bordered">
					@foreach($user->events as $event)
						<tr>
							@if($event->pivot->status == 2)
                                <td style="width:30px"><div class="btn btn-warning"><i class="glyphicon glyphicon-question-sign"></i></div></td>
                            @elseif($event->pivot->status == 1)
                                <td style="width:30px"><div class="btn btn-success"><i class="glyphicon glyphicon-ok-circle"></i></div></td>
                            @elseif($event->pivot->status == 0)
                                <td style="width:30px"><a href="#"><div class="btn btn-danger"><i class="glyphicon glyphicon-remove-circle"></i></div></a></td>
                            @endif
							<td><a href="{{ URL::action('confirm', [$event->pivot->myevent_id, $event->pivot->user_id, $event->pivot->subgroup_id]) }}"><button>yes</button></a> <a href="{{ URL::action('deny', [$event->pivot->myevent_id, $event->pivot->user_id, $event->pivot->subgroup_id]) }}"><button>no</button></a></td>
							<td>{{$event->name}}</td>

							<td>
								<table>
									@foreach($event->groups as $group)
									<tr>
										<th>
											{{$group->name}}
										</th>
									</tr>
									<tr>
										<td>
											<table>
												@foreach($group->subgroups as $subgroup)
													<tr>
													@if($subgroup->id == $event->pivot->subgroup_id)
														<td>{{$subgroup->name}}</td>
													@endif
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
</div>
@stop