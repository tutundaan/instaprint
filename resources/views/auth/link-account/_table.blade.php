<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nama</th>
			<th>ID</th>
			<th>Akun</th>
			<th>Aksi</th>
		</tr>
	</thead>

	<tbody>
		@forelse ($employees as $i => $employee)
		<tr>
			<td>{{ $i + $employees->firstItem() }}</td>
			<td>{{ $employee->formattedName() }}</td>
			<td>{{ $employee->number }}</td>
            <td>
                @include('auth.link-account._status')
			</td>
            <td>
                @include('auth.link-account._create')
                @include('auth.link-account._unlink')
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
