<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Jam</th>
            <th>Keterangan</th>
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
                <td>{{ $attendance->first()->recordedTime()->format('H:i') }} {{ $attendance->first()->timeStatus() }}</td>
                <td>{{ $attendance->first()->evaluation() }}</td>
            </tr>
            @foreach($attendance as $item)
                @if($item->id !== $skip)
                <tr>
                    <th colspan="2"></th>
                    <td>{{ $item->recordedTime()->format('H:i') }} {{ $item->timeStatus() }}</td>
                    <td>{{ $item->evaluation() }}</td>
                </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
