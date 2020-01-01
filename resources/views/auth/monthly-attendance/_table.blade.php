<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nama Pegawai</th>
			<th>Absen Masuk</th>
			<th>Absen Keluar</th>
			<th>Tanggal</th>
			<th>Keterlambatan</th>
			<th>Hari Absen dalam satu bulan</th>
		</tr>
	</thead>

	<tbody>
		@forelse ($attendances as $i => $attendance)
			<tr>
				<th>{{ $i + $attendances->firstItem() }}</th>
				<td>{{ $attendance->employee->name() }}</td>
				<td>{{ $attendance->getInAttendanceTime() }}</td>
				<td>{{ $attendance->getOutAttendanceTime() }}</td>
				<td>{{ $attendance->recordedDateTime()->format('l, d F Y') }}</td>
				<td>{{ $attendance->additionalDuration() }}</td>
				<td>{{ $attendance->days_number_in_month }}</td>
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
