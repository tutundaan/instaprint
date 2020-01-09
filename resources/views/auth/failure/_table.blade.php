<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nama</th>
			<th>Catatan</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach ($failures as $i => $failure)
		<tr>
			<td>{{ $i + $failures->firstItem() }}</td>
			<td>{{ $failure->holder }}</td>
			<td>{{ $failure->note }}</td>
            <td>
                @include('auth.failure._show')
            </td>
		</tr>
		@endforeach
	</tbody>
</table>
