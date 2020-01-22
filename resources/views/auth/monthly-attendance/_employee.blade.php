<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Jam</th>
            <th>Keterangan</th>
            <th>Evaluasi</th>
        </tr>
    </thead>

    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach($attendances as $attendance)
            @php
                $skip = $attendance->first()->id;
            @endphp
            <tr>
                <th>{{ $i++ }}</th>
                <th>{{ $attendance->first()->employee->formattedName() }}</th>
                <td>{{ $attendance->first()->timeStatus() }}</td>
                <td>{{ $attendance->first()->notes() }}</td>
                <td><span class="badge badge-success">{{ $attendance->first()->evaluation() }}</span></td>
            </tr>
            @foreach($attendance as $item)
                @if($item->id !== $skip)
                <tr>
                    <th colspan="2"></th>
                    <td>{{ $item->timeStatus() }}</td>
                    <td>{{ $item->notes() }}</td>
                    <td><span class="badge badge-success">{{ $item->evaluation() }}</span></td>
                </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
