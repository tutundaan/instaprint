<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach ($users as $i => $user)
		<tr>
			<td>{{ $i + $users->firstItem() }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->role->name }}</td>
			<td>
				@include('auth.user._edit')
				@include('auth.user._destroy')
			</td>
		</tr>
		@endforeach
	</tbody>
</table>