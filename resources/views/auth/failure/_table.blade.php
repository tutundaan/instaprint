<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
            <th>Job Order</th>
			<th>Customer</th>
			<th>Karyawan</th>
			<th>Catatan</th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		@foreach ($failures as $i => $failure)
		<tr>
			<td>{{ $i + $failures->firstItem() }}</td>
			<th>{{ $failure->number }}</th>
			<td>{{ $failure->holder }}</td>
			<th>{{ $failure->employee->name ?? '-' }}</th>
			<td>{{ $failure->note }}</td>
            <td>
                <div class="row">
                    <div class="col-6">
                        @include('auth.failure._show')
                    </div>
                    <div class="col-6">
                        @include('auth.failure._relink' , ['data' => $failure])
                    </div>
                </div>
            </td>
		</tr>
		@endforeach
	</tbody>
</table>
