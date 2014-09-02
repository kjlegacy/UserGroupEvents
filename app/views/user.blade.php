@extends('layout.master')

@section('content')

<a href="{{ URL::route('home') }}"><button class="btn btn-primary">Home</button></a>

<form action="{{ URL::route('detach-user') }}" method="post">
<table class="table">
	<tr>
		<th>User</th>
		<th><button type="submit" class="btn btn-default">Detach</button></th>
		<th>Subgroup</th>
	</tr>
@foreach($user_data as $user)
	<tr>
		<td>{{$user->name}}</td>
		<td></td>
		<td>
			<table class="table">
				@foreach($user->subgroups as $subgroup)
				<tr>
					<td><input type="checkbox" name="subgroup[]" value="{{$subgroup->id}}">{{$subgroup->name}}</td>
					<td>
						<table>
								<tr>
									<th>In-Group</th>
								</tr>
							@foreach($subgroup->groups as $group)
								<tr>
									<td>{{ $group->name }}</td>
								</tr>
							@endforeach
						</table>
					</td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
	<input style="display:none;" type="text" name="user_id" value="{{ $user->id }}">
@endforeach
</table>
</form>

@stop