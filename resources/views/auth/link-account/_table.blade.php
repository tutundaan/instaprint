<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nama</th>
			<th>ID</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@forelse ($employees as $i => $employee)
		<tr>
			<td>{{ $i + $employees->firstItem() }}</td>
			<td>{{ $employee->name }}</td>
			<td>{{ $employee->number }}</td>
            <td>
                @include('auth.link-account._create')
			</td>
		</tr>
		@empty
		<tr>
		    <td>
		        <p>Tidak ada data</p>
		    </td>
		</tr>
		@endforelse
	</tbody>
</table>
