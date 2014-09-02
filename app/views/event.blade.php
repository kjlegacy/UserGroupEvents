@extends('layout.master')

@section('content')

<a href="{{ URL::route('home') }}"><button class="btn btn-primary">Home</button></a>

<form action="{{ URL::route('detach-group') }}" method="post">
<table class="table">
	<tr>
		<th>Event</th>
		<th><button type="submit" class="btn btn-default">Detach</button></th>
		<th>Group</th>
	</tr>
@foreach($event_data as $event)
	<tr>
		<td>{{$event->name}}</td>
		<td></td>
		<td>
			<table class="table">
				@foreach($event->groups as $group)
				<tr>
					<td><input type="checkbox" name="group[]" value="{{$group->id}}">{{$group->name}}</td>
					<td>
						<table class="table">
								<tr>
									<th>Subgroups</th>
								</tr>
							@foreach($group->subgroups as $subgroup)
								<tr>
									<td>{{ $subgroup->name }}</td>
									<td>
										<table>
											<tr>
												<th>users</th>
											</tr>
											@foreach($subgroup->users as $user)
												<tr>
													<td>{{ $user->name }}</td>
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
	<input style="display:none;" type="text" name="event_id" value="{{ $event->id }}">
@endforeach
</table>
</form>

@stop