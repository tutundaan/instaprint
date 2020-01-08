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
                <div class="row">
                    <div class="col-3">
                        @include('auth.link-account._link')
                    </div>
                    <div class="col-3">
                        @include('auth.link-account._create')
                    </div>
                    <div class="col-3">
                        @include('auth.link-account._unlink')
                    </div>
                    <div class="col-3">
                        @include('auth.link-account._update')
                    </div>
                </div>
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
