@extends('layout.master')

@section('content')

<a href="{{ URL::route('home') }}"><button class="btn btn-primary">Home</button></a>

<form action="{{ URL::route('detach-subgroup') }}" method="post">
<table class="table">
	<tr>
		<th>Group</th>
		<th><button type="submit" class="btn btn-default">Detach</button></th>
		<th>Subgroup</th>
	</tr>
@foreach($group_data as $group)
	<tr>
		<td>{{$group->name}}</td>
		<td></td>
		<td>
			<table class="table">
				@foreach($group->subgroups as $subgroup)
				<tr>
					<td><input type="checkbox" name="subgroup[]" value="{{$subgroup->id}}">{{$subgroup->name}}</td>
					<td>
						<table>
								<tr>
									<th>Users-in-subgroup</th>
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
	<input style="display:none;" type="text" name="group_id" value="{{ $group->id }}">
@endforeach
</table>
</form>

@stop