<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Karyawan Hadir</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @php
            $i = 0;
        @endphp
        @foreach($attendances as $key => $attendance)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ Carbon\Carbon::parse($key)->format('d F Y') }}</td>
            <td><strong>{{ $attendance->count() }}</strong> Karyawan </td>
            <td><a class="btn btn-primary btn-xs btn-block" href="">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
