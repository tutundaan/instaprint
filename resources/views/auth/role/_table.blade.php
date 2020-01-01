
<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nama</th>
			<th>Jumlah Pengguna</th>
			<th>Jumlah Blok Akses</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($roles as $i => $role)
		<tr>
			<th>{{ ++$i }}</th>
			<td>{{ $role->name }}</td>
			<td><span class="badge badge-success">{{ $role->users->count() }} Pengguna</span></td>
			<td><span class="badge badge-warning">{{ $role->blockedUsers->count() }} Pengguna</span></td>
		</tr>
		@endforeach
	</tbody>
</table>
